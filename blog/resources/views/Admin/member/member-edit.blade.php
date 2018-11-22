<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!-- <link type="text/css" rel="stylesheet" href="css/H-ui.css"/>
<link type="text/css" rel="stylesheet" href="css/H-ui.admin.css"/> -->
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />

<!-- <link type="text/css" rel="stylesheet" href="font/font-awesome.min.css"/> -->
<!--[if IE 7]>
<link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>修改会员信息</title>
</head>
<body>
<div class="pd-20">
  <div class="Huiform">
    <form action="javascript:;">
      <table class="table table-bg">
        <tbody>
        
            <tr>
                <th width="100" class="text-r"><span class="c-red">*</span> 用户名：</th>
                <td>
                    <input type="text" style="width:300px;" class="input-text" value="{{$member_info['user_name']}}" placeholder="" id="user-tel" name="name">
                    <span class="mb25" id="nameexist" style="color: red;display: block;line-height: 20px"></span>
                </td>
                
            </tr>
            <tr>
                <th width="100" class="text-r"><span class="c-red">*</span> 密码：</th>
                <td>
                    <input type="password" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="pass">
                    <span class="mb25" id="passexist" style="color: red;display: block;line-height: 20px"></span>
                    </td>
            </tr>
            </tr>
            <tr>
                <th width="100" class="text-r"><span class="c-red">*</span> 确认密码：</th>
                <td>
                    <input type="password" style="width:300px" class="input-text" value="" placeholder="" id="user-tel" name="repass">
                    <span class="mb25" id="repassexist" style="color: red;display: block;line-height: 20px"></span>
                    </td>
            </tr>
            <tr>
                <th class="text-r"><span class="c-red">*</span> 性别：</th>
                <td>
                    <label>
                        　<input type="radio" name="sex" value="1" {{$member_info['sex']==1?'checked':''}}>男
                        　<input type="radio" name="sex" value="2" {{$member_info['sex']==2?'checked':''}}>女

                        　<input type="radio" name="sex" value="0" {{$member_info['sex']==0?'checked':''}}>保密
                    </label>
                </td>
            </tr>
            <tr>
                <th class="text-r"><span class="c-red">*</span> 手机：</th>
                <td>
                    <input type="text" style="width:300px" class="input-text" value="{{$member_info['phone']}}" placeholder="" id="user-tel" name="phone">
                    <span class="mb25" id="phoneexist" style="color: red;display: block;line-height: 20px"></span>

                </td>
            </tr>
            <tr>
                <th class="text-r">邮箱：</th>
                <td>
                    <input type="text" style="width:300px" class="input-text" value="{{$member_info['email']}}" placeholder="" id="user-email" name="email">
                    <span class="mb25" id="emailexist" style="color: red;display: block;line-height: 20px"></span>
                </td>
            </tr>
            <tr>
                <th class="text-r">用户等级：</th>
                <td>

                    <label> 
                        <input type="radio" name="rank" value="1" id="rank_1" {{$member_info['rank']==1?'checked':''}}>普通用户
                        <input type="radio" name="rank" value="2" id="rank_2" {{$member_info['rank']==2?'checked':''}}>VIP用户
                        <input type="radio" name="rank" value="3" id="rank3" {{$member_info['rank']==3?'checked':''}} >钻石用户
                    </label>
                </td>
            </tr>
            <tr>
                <th class="text-r"></th>
                <td>
                    <span class="mb25" id="exist" style="color: red;display: block;line-height: 20px"></span>
                </td>
            </tr>
            <tr>
            <th></th>
                <td><button class="btn btn-success radius"><i class="icon-ok"></i> 确定</button></td>
            </tr>
        
        </tbody>
      </table>
    </form>
  </div>
</div>
<!-- <script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="js/Validform_v5.3.2_min.js"></script>  -->
<!-- <script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script> -->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery-1.12.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> 
<script type="text/javascript">
// $(".Huiform").Validform(); 
</script>
<script>
// var _hmt = _hmt || [];
// (function() {
//   var hm = document.createElement("script");
//   hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
//   var s = document.getElementsByTagName("script")[0]; 
//   s.parentNode.insertBefore(hm, s);
// })();
// var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
// document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
    //判断用户名是否存在
    $('input[name="name"]').blur(function () {
        $('span#nameexist').html('');
        var id = "{{$member_info['id']}}";
        var uname = $('input[name="name"]').val();
        var ret = /^[a-zA-Z][a-zA-Z0-9_-]{3,10}$/;
        if (!ret.test(uname)) {
            console.log(ret.test(uname));
            $('span#nameexist').html('用户名必须以字母开头，数字、下划线组合且字符4-10位！').css('color', 'red');
            return false;
        } 
        $.ajax({
            type: 'post',
            url:'{{ url("admin/member/checkusername") }}',
            data: 'uname='+uname+'&id='+id+'&_token={{csrf_token()}}',
            success:function (data) {
                console.log(data);
                if (data.status==1) {
                    //用户名可以使用
                    $('span#nameexist').html(data.msg).css('color', 'red');
                } else if (data.status==2) {
                    //用户名已被使用
                    $('span#nameexist').html(data.msg).css('color', 'red');
                }
            }, 
            dataType:'json'
        }); 
    });

    //密码验证
    $('input[name="pass"]').blur(function () {
        $('span#passexist').html('');
        var upass = $('input[name="pass"]').val();
        var ret = /^\S{6,20}$/;
        var reg=/^(?![0-9]+$)(?![a-zA-Z]+$)(?!([^(0-9a-zA-Z)]|[\(\)])+$)([^(0-9a-zA-Z)]|[\(\)]|[a-zA-Z]|[0-9]){6,20}$/;
        if (!ret.test(upass)) {
            // console.log(upass.length);
            $('span#passexist').html('密码长度必须6-20位！').css('color', 'red');
            return false;
        } else if (!reg.test(upass)) {
            $('span#passexist').html('密码强度较弱，建议使用两种任意类型组合！').css('color', 'red');
        }
    });

    //确认密码判断
    $('input[name="repass"]').blur(function () {
        $('span#repassexist').html(''); 
        var upass = $('input[name="pass"]').val();
        var repass = $('input[name="repass"]').val();
        if (upass != repass) {
                $('span#repassexist').html('两次密码不一致！').css('color', 'red');
                return false;
        }
    });

    //判断用户手机号
    $('input[name="phone"]').blur(function () {
        $('span#phoneexist').html('');
        var id = "{{$member_info['id']}}";
        var uphone = $('input[name="phone"]').val();
        // console.log(uphone);
        var ret = /^1[34578]\d{9}$/;
        if (!ret.test(uphone)) {
            // console.log(ret.test(uphone));
            $('span#phoneexist').html('请正确输入手机号码！').css('color', 'red');
            return false;
        }
        $.ajax({
            type: 'post',
            url: '{{ url("admin/member/checkphonenumber") }}',
            data: 'id='+id+'&phone='+uphone+'&_token={{csrf_token()}}',
            success:function (data) {
                 if (data.status==3) {
                    //该手机号可以注册
                    $('span#phoneexist').html(data.msg).css('color', 'red');
                } else if (data.status==4) {
                    //该手机号已被注册
                    $('span#phoneexist').html(data.msg).css('color', 'red');
                }
            },  
            dataType:'json'
        }); 
    });
    //判断邮箱
    $('input[name="email"]').blur(function () {
        $('span#emailexist').html('');  
        var uemail = $('input[name="email"]').val();
        var ret = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
        if (!ret.test(uemail)) {
            $('span#emailexist').html('邮箱不合法！').css('color', 'red');
            return false;
        }
    });

    $('button').click(function () {
        var nameVal = $('input[name="name"]').val();
        var pwdVal = $('input[name="pass"]').val();
        var repwdVal = $('input[name="repass"]').val();
        var sexVal = $("input[name='sex']:checked").val();
        var phoneVal = $('input[name="phone"]').val();
        var emailVal = $('input[name="email"]').val();
        var rankVal = $("input[name='rank']:checked").val();
        var id = "{{$member_info['id']}}";
        // console.log(id);return false;
        // console.log(sexVal); 
        $('span#nameexist').html('');
        $('span#passexist').html('');
        $('span#repassexist').html(''); 
        $('span#phoneexist').html('');
        $('span#emailexist').html('');
        $('span#exist').html('');
        if(!nameVal){
            $('span#nameexist').html('用户名不能为空！');
            return;
        }
        if(!pwdVal){
            $('span#passexist').html('密码不能为空！');
            return false;
        }
        if(!repwdVal){
            $('span#repassexist').html('确认密码不能为空！');
            return false;
        }
        
        if(!emailVal){
            $('span#emailexist').html('邮箱不能为空！');
            return false;
        }
        if(!phoneVal){
            $('span#phoneexist').html('手机不能为空！');
            return false;
        }
        $.ajax({
                type: 'post',
                url: '{{ url("admin/member/save") }}',
                data: 'id='+id+'&name='+nameVal+'&pass='+pwdVal+'&repass='+repwdVal+'&phone='+phoneVal+'&email='+emailVal+'&sex='+sexVal+'&rank='+rankVal+'&_token={{csrf_token()}}',
                success:function (data) {

                    if (data=='error'){
                        $('span#exist').html('注册失败，请你重新检查输入信息！').css('color', 'red');
                        return false;
                    }
                    // console.log(data);
                    if ( data.status == 0 ) {
                        // 修改成功
                        layer.msg(data.msg,{icon:1,time:3000});
                        location.href ='{{ url("admin/member/index") }}';
                    } else {
                        layer.msg(data.msg,{icon:1,time:3000});
                    }
                },  

                dataType:'json'
            }); 
       
    });
</script>
</body>
</html>