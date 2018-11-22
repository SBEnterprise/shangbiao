<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;



/**
* 上传图片到七牛云
*   lizhentao qq1214685942@gmail.com
* @return 将数据信息返回后台品牌首页
*/
class UploadController extends Controller
{
   
	//上传图片到七牛云
  	public function uploadToQiNiu(Request $request, $fileName = 'pic')
    {

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

        $imglink = 'http://owzyol3tb.bkt.clouddn.com/'.$key;
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($res, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {

            return ['status'=>4044,'msg'=>'失败', 'data' => $err];

        } else {
            $info = [
              'status' => '2200',
              'msg'    => '上传成功',
              'data'   => $res,
              'imglink' => $imglink
            ];

            return $info;

        }
    }

}
