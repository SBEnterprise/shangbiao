<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use session;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


/**
 *
 * 验证码生成及上传文件处理类
 * @author chenxiaodong <[<229168653@qq.com>]>
 */
class CommonApi extends Controller
{

  //生成验证码
  public function buildCode(Request $request)
  {
    $builder = new CaptchaBuilder;
    $builder->build();

    //获取验证码内容
    $phrase = $builder->getPhrase();
    //将验证码存到session
     // $request->session()->put('code', $phrase);
     $request->session()->flash('code', $phrase);
    //  \Session::save();
    //生成图片
    header("Cache-Control: no-cache, must-revalidate");
    header('Content-Type: image/jpeg');
    $builder->output();

    // exit;
  }


  /**
   * 验证码验证
   * @author chenxiaodong <[<229168653@qq.com>]>
   */
  public  static function CheckCode (Request $request, $formCodeName = 'code')
  {
       $userCode = $request->input($formCodeName);
       if ( $request->session()->get('code') == $userCode ) {
           return	true;
       }
       return false;
  }


  public function json($code, $msg, $data = [])
  {
    return response()->json([
      'status' => $code,
      'msg'    => $msg,
      'data'  => $data,
    ]);
  }

  //文件上传
  public function upload(
    Request $request,
    $formFileName = 'img',
    $allowExt = ['jpg', 'png', 'gif', 'jpeg']
  )
  {

      if (!$request->hasFile($formFileName)) {

        return $this->json(1404, '文件不存在');
      }

      //获取到文件的扩展名
      $extension = $request->$formFileName->extension();

      //判断扩展是不是允许上传的类型
      if (!in_array($extension, $allowExt)) {

          return $this->json(1401, '上传文件类型错误');
      }

      $fileName = $request->$formFileName->store('image');

      // return $this->json(1200, '文件上传成功', ['path' => $fileName]);
      return $fileName;
      // dd($extension);
  }


  //七牛云上传图片 LIZHENTAO
  public function uploadToQiNiu(Request $request, $fileName = 'pic')
      {
          // echo '111';die;
          $file = $request->file($fileName);
          if(!$file){
            return [
              'status' => 4403,
              'msg'    => '没有上传文件',
            ];
          }
          if(!$file->isValid()){
            return [
              'status' => 4401,
              'msg'    => '上传文件不合法',
            ];
          }

          // 需要填写你的 Access Key 和 Secret Key,具体查看七牛后台
          $accessKey = env('QINIU_ACCESSKEY');
          $secretKey = env('QINIU_SECRETKEY');

          // 构建鉴权对象
          $auth = new Auth($accessKey, $secretKey);


          // 要上传的空间,这是在你七牛后台设置的
          $bucket = env('QINIU_BUCKET');

          // 生成上传 Token
          $token = $auth->uploadToken($bucket);

          // 要上传文件的本地路径
          $filePath = $file->getRealPath();

          // 上传到七牛后保存的文件名
          $date = time().uniqid();
          $key = $date.'.'.$file->getClientOriginalExtension();

          // 初始化 UploadManager 对象并进行文件的上传。
          $uploadMgr = new UploadManager();

          $goodimages = 'http://owtstcm4k.bkt.clouddn.com/'.$key;
          // 调用 UploadManager 的 putFile 方法进行文件的上传。
          list($res, $err) = $uploadMgr->putFile($token, $key, $filePath);
          if ($err !== null) {

              return ['status'=>4044,'msg'=>'失败', 'data' => $err];

          } else {
              $info = [
                'status' => '2200',
                'msg'    => '上传成功',
                'data'   => $res,
                'goodimages' => $goodimages
              ];

              return $info;

          }
      }


      /**
       *螺丝帽
       * 向用户发送短信类
       * @param array $phone 特定手机的标识
       * @param string $message 需要发送的消息
       */
      public function sendMsg($phone)
      {

          //随机生成5五位数验证码
          $arr = rand(10000,99999);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

          curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
          curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-470325c79b1ccdd7ea4ec2112da4ac0c');
          curl_setopt($ch, CURLOPT_POST, TRUE);
          $msg = '尊敬的用户，您的验证码是：'.$arr.'，在60秒内有效。如非本人操作请忽略本短信。【上表企业】';
          curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $phone,'message' => $msg));
          $res = curl_exec( $ch );
          curl_close( $ch );
          $art = json_decode($res, true);

          if($art['error']==0){
              echo json_encode(['status'=>1, 'msg'=>'发送成功'], JSON_UNESCAPED_UNICODE);
              return;
           }
           if($art['error']==-42){
             echo json_encode(['status'=>42, 'msg'=>'点击频率过快，60s后再试'],JSON_UNESCAPED_UNICODE);
             return;
           }
           if($art['error']==-40){
             echo json_encode(['status'=>4, 'msg'=>'手机号码错误'],JSON_UNESCAPED_UNICODE);
             return;
           }
           echo json_encode(['status'=>4040, 'msg'=>'发送失败，重新获取验证码'],JSON_UNESCAPED_UNICODE);
           return;

      }




}
