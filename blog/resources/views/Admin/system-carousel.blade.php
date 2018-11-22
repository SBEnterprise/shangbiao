<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>商品列表</title>

</head>
<body class="pos-r">
<div>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form action="{{url('admin/product/product-list')}}" method="get">
                <input type="text" name="brand_name" id="" placeholder="品牌" style="width:250px" class="input-text">
                <input type="text" name="goods_name" id="" placeholder="商品名" style="width:250px" class="input-text">
                <button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜吧</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" onclick="product_add('添加商品属性', '{{url("admin/carouselAdd")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> <span class="r">共有数据：<strong></strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover ">
                <thead>
                <tr class="text-c">
                    <th width="40" >ID</th>
                    <th width="80">图片</th>
                    <th width="80">说明</th>
                    <th width="100">链接地址</th>
                    <th width="40">状态</th>
                    <th width="80">添加时间</th>
                    <th width="80">修改时间</th>
                    <th width="45">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carouselData as $v)
                    <tr class="text-c va-m">
                        <td class="id">{{$v->id}}</td>
                        <td>
                            <img width="60" class="product-thumb" src="{{$v->pic_url}}" id="{{$v->id}}">
                        </td>
                        <td class="text-l">{{$v->title}}</td>
                        <td class="text-l">{{$v->path_url}}</td>
                        <td class="text-l">
								@if ($v->status ==1)
                                <span class="label label-success radius">
                                    <a style="text-decoration:none;font-size:12px; color:white" sid="{{$v->id}}" stat="{{$v->status}}" href="javascript:void(0);" title="启用" class="stop">
                                       启用
                                    </a>
                                </span>
                                @else
                                <span class="label label-danger radius">
                                    <a style="text-decoration:none; font-size:12px; color:yellow" sid="{{$v->id}}" stat="{{$v->status}}" href="javascript:void(0);" title="禁用" class="stop">
                                       禁用
                                    </a>
                                </span>
                                @endif
                        </td>
                        {{--<td class="text-l">{{$v->sales_num}}</td>--}}
                        <td><span class="price">{{$v->created_at}}</span></td>
                        <td><span class="price">{{$v->updated_at}}</span></td>
                        <td class="td-manage" >
                            {{--<a style="text-decoration:none" sid="{{$v->id}}" stat="{{$v->status}}" href="javascript:void(0);" title="禁用" class="stop">--}}
                                {{--<i class="Hui-iconfont">&#xe6de;</i>--}}
                            {{--</a>--}}
                            <a style="text-decoration:none" class="ml-5" onClick="product_edit('修改轮播图图片', '{{url('/admin/carouselEdit', $v->id)}}')" href="javascript:;" title="修改轮播图片">
                                <i class="Hui-iconfont edit">&#xe6df;</i>
                            </a>
                            <a style="text-decoration:none" onClick="product_del(this, '{{$v->id}}')" href="javascript:;" title="删除"><i class="Hui-iconfont" >&#xe6e2;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$carouselData->links()}}
        </div>
        <div class="error btn btn-success" style="display:none"></div>
    </div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>

<script type="text/javascript">

    var urlObj = {
        'del' :  '{{url("/admin/delCarousel")}}',
        'updateStatus':   '{{ url("/admin/updateStatus") }}'
    };


    //修改轮播图是否显示在首页
    $('a.stop').on('click', function () {
        var id = $(this).attr('sid');
        var status = $(this).attr('stat');
        $.post(
            urlObj.updateStatus,
            {id: id, status: status, _token: "{{csrf_token()}}" },
            function (data) {
                if (data.status==0) {
                    $('div.error').html(data.msg).css('display', 'block');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                    var status = $(this).attr('stat');
                    if (status==0) {
                        $(this).attr('stat', 1);
                    } else if (status==1) {
                        $(this).attr('stat', 0);
                    }
                } else {
                    $('div.error').html(data.msg).css('display', 'block');
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }
            },
            'json'
        );
    });

    var setting = {
        view: {
            dblClickExpand: false,
            showLine: false,
            selectedMulti: false
        },
        data: {
            simpleData: {
                enable:true,
                idKey: "id",
                pIdKey: "pId",
                rootPId: ""
            }
        },

        callback: {
            beforeClick: function(treeId, treeNode) {
                var zTree = $.fn.zTree.getZTreeObj("tree");
                if (treeNode.isParent) {
                    zTree.expandNode(treeNode);
                    return false;
                } else {
                    //demoIframe.attr("src",treeNode.file + ".html");
                    return true;
                }
            }
        }
    };

    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
        ]
    })

    /*产品-添加*/
    function product_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*产品-查看*/
    function product_show(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*产品-编辑*/
    function product_edit(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*商品属性-新增*/
    /*function detail_add(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }*/

    $('i.add').click(function () {
        var id = $(this).attr('id');
        $.post(
            '{{url("/check")}}',
            {id: id, _token: '{{ csrf_token() }}'},
            function (data) {
                if (data.status==0) {
                    //console.log(data);
                    // $('div.error').html(data.msg).css('display', 'block');
                    var index = layer.open({
                        type: 2,
                        title: '商品详情添加',
                        content: '{{url("admin/product/detail-add")}}/'+data.data.id
                    });
                    layer.full(index);
                } else {
                    $('div.error').html(data.msg).css('display', 'block');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
            'json'
        );
    });


    function product_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'get',
                url:  '{{url('/admin/delCarousel')}}',
                data:   'id='+id,
                success: function(data){
                    if (data.status==1) {
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg+'!', {icon:1,time:2000});
                    }
                },
                error:function(data) {

                },
                dataType: 'json'
            });
        });
    }

</script>
</body>
</html>