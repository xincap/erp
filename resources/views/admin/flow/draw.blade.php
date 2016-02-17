<!DOCTYPE HTML>
<html>
    <head>
        <title>流程设计器 Flowdesign.leipi.org</title>
        <meta name="keyword" content="流程设计器,Web Flowdesign,Flowdesigner,专业流程设计器,WEB流程设计器">
        <meta name="description" content="国内最容易使用和开发的流程设计器，你可以在此基础上任意修改使功能无限强大！">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="author" content="leipi.org">
        <link href="/css/bootstrap/css/bootstrap.css?{{$version}}" rel="stylesheet" type="text/css" />
        <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/bootstrap-ie6.css?{{$version}}">
        <![endif]-->
        <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/css/ie.css?{{$version}}">
        <![endif]-->
        <link href="/css/site.css?{{$version}}" rel="stylesheet" type="text/css" />


        <script type="text/javascript">
            var _root = '{$_site_url}{:U(' / ')}', _controller = '{$_controller}';
        </script>
        <link rel="stylesheet" type="text/css" href="/js/flowdesign/flowdesign.css"/>

        <!--select 2-->
        <link rel="stylesheet" type="text/css" href="/js/jquery.multiselect2side/css/jquery.multiselect2side.css"/>
    </head>
    <body>



        <!-- fixed navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div class="pull-right">
                        <button class="btn btn-info" type="button" id="leipi_save">保存设计</button>
                        <button class="btn btn-danger" type="button" id="leipi_clear">清空连接</button>
                    </div>

                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <a class="brand" href="{:U('/demo')}" target="_blank">DEMO</a>
                            <li><a href="javascript:void(0);">正在设计【请假申请流程】</a></li>
                        </ul>
                    </div>

                </div><!-- container -->
            </div>
        </div>
        <!-- end fixed navbar -->



        <!-- Modal -->
        <div id="alertModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>消息提示</h3>
            </div>
            <div class="modal-body">
                <p>提示内容</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">我知道了</button>
            </div>
        </div>

        <!-- attributeModal -->
        <div id="attributeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:800px;margin-left:-350px">
            <div class="modal-body" style="max-height:500px;"><!-- body --></div>
            <div class="modal-footer" style="padding:5px;">
                <a href="http://www.leipi.org" target="_blank"><img src="http://www.leipi.org/wp-content/themes/leipi/images/leipi.png" alt="雷劈认证 icon" style="width:40px"></a>
                <!--a href="#" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-white"></i></a-->
            </div>
        </div>



        <!--contextmenu div-->
        <div id="processMenu" style="display:none;">
            <ul>
              <!--li id="pm_begin"><i class="icon-play"></i>&nbsp;<span class="_label">设为第一步</span></li-->
              <!--li id="pm_addson"><i class="icon-plus"></i>&nbsp;<span class="_label">添加子步骤</span></li-->
              <!--li id="pm_copy"><i class="icon-check"></i>&nbsp;<span class="_label">复制</span></li-->
                <li id="pmAttribute"><i class="icon-cog"></i>&nbsp;<span class="_label">属性</span></li>
                <li id="pmForm"><i class="icon-th"></i>&nbsp;<span class="_label">表单字段</span></li>
                <li id="pmJudge"><i class="icon-share-alt"></i>&nbsp;<span class="_label">转出条件</span></li>
                <li id="pmSetting"><i class=" icon-wrench"></i>&nbsp;<span class="_label">样式</span></li>
                <li id="pmDelete"><i class="icon-trash"></i>&nbsp;<span class="_label">删除</span></li>

            </ul>
        </div>
        <div id="canvasMenu" style="display:none;">
            <ul>
                <li id="cmSave"><i class="icon-ok"></i>&nbsp;<span class="_label">保存设计</span></li>
                <li id="cmAdd"><i class="icon-plus"></i>&nbsp;<span class="_label">添加步骤</span></li>
                <li id="cmRefresh"><i class="icon-refresh"></i>&nbsp;<span class="_label">刷新 F5</span></li>
                <!--li id="cmPaste"><i class="icon-share"></i>&nbsp;<span class="_label">粘贴</span></li-->
                <li id="cmHelp"><i class="icon-search"></i>&nbsp;<span class="_label">帮助</span></li>
            </ul>
        </div>
        <!--end div--> 

        <div class="container mini-layout" id="flowdesign_canvas">
            <!--div class="process-step btn" style="left: 189px; top: 340px;"><span class="process-num badge badge-inverse"><i class="icon-star icon-white"></i>3</span> 步骤3</div-->
        </div> <!-- /container -->




        <script type="text/javascript" src="/js/jquery-1.7.2.min.js?{{$version}}"></script>
        <script type="text/javascript" src="/css/bootstrap/js/bootstrap.min.js?{{$version}}"></script>
        <script type="text/javascript" src="/js/jquery-ui/jquery-ui-1.9.2-min.js?{{$version}}" ></script>
        <script type="text/javascript" src="/js/jsPlumb/jquery.jsPlumb-1.3.16-all-min.js?{{$version}}"></script>
        <script type="text/javascript" src="/js/jquery.contextmenu.r2.js?{{$version}}"></script>
        <!--select 2-->
        <script type="text/javascript" src="/js/jquery.multiselect2side/js/jquery.multiselect2side.js?{{$version}}" ></script>
        <!--flowdesign-->
        <script type="text/javascript" src="/js/flowdesign/leipi.flowdesign.v3.js?{{$version}}"></script>
        <script type="text/javascript">
            var the_flow_id = '{{$one["id"]}}';

            /*页面回调执行    callbackSuperDialog
             if(window.ActiveXObject){ //IE  
             window.returnValue = globalValue
             }else{ //非IE  
             if(window.opener) {  
             window.opener.callbackSuperDialog(globalValue) ;  
             }
             }  
             window.close();
             */
            function callbackSuperDialog(selectValue) {
                var aResult = selectValue.split('@leipi@');
                $('#' + window._viewField).val(aResult[0]);
                $('#' + window._hidField).val(aResult[1]);
                //document.getElementById(window._hidField).value = aResult[1];

            }
            /**
             * 弹出窗选择用户部门角色
             * showModalDialog 方式选择用户
             * URL 选择器地址
             * viewField 用来显示数据的ID
             * hidField 隐藏域数据ID
             * isOnly 是否只能选一条数据
             * dialogWidth * dialogHeight 弹出的窗口大小
             */
            function superDialog(URL, viewField, hidField, isOnly, dialogWidth, dialogHeight)
            {
                dialogWidth || (dialogWidth = 620)
                        , dialogHeight || (dialogHeight = 520)
                        , loc_x = 500
                        , loc_y = 40
                        , window._viewField = viewField
                        , window._hidField = hidField;
                // loc_x = document.body.scrollLeft+event.clientX-event.offsetX;
                //loc_y = document.body.scrollTop+event.clientY-event.offsetY;
                if (window.ActiveXObject) { //IE  
                    var selectValue = window.showModalDialog(URL, self, "edge:raised;scroll:1;status:0;help:0;resizable:1;dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;dialogTop:" + loc_y + "px;dialogLeft:" + loc_x + "px");
                    if (selectValue) {
                        callbackSuperDialog(selectValue);
                    }
                } else {  //非IE 
                    var selectValue = window.open(URL, 'newwindow', 'height=' + dialogHeight + ',width=' + dialogWidth + ',top=' + loc_y + ',left=' + loc_x + ',toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');

                }
            }




            $(function () {
                var alertModal = $('#alertModal'), attributeModal = $("#attributeModal");
                //消息提示
                mAlert = function (messages, s)
                {
                    if (!messages)
                        messages = "";
                    if (!s)
                        s = 2000;
                    alertModal.find(".modal-body").html(messages);
                    alertModal.modal('toggle');
                    setTimeout(function () {
                        alertModal.modal("hide")
                    }, s);
                }

                //属性设置
                attributeModal.on("hidden", function () {
                    $(this).removeData("modal");//移除数据，防止缓存
                });
                ajaxModal = function (url, fn)
                {
                    url += url.indexOf('?') ? '&' : '?';
                    url += '_t=' + new Date().getTime();
                    attributeModal.find(".modal-body").html('<img src="/images/loading.gif"/>');
                    attributeModal.modal({
                        remote: url
                    });

                    //加载完成执行
                    if (fn)
                    {
                        attributeModal.on('shown', fn);
                    }


                }
                //刷新页面
                function page_reload()
                {
                    location.reload();
                }



                /*
                 php 命名习惯 单词用下划线_隔开
                 js 命名习惯：首字母小写 + 其它首字线大写
                 */
                /*步骤数据*/
                var processData = {!!$process_data!!};

                /*创建流程设计器*/
                var _canvas = $("#flowdesign_canvas").Flowdesign({
                    "processData": processData
                            /*,mtAfterDrop:function(params)
                             {
                             //alert("连接："+params.sourceId +" -> "+ params.targetId);
                             }*/
                            /*画面右键*/
                    , canvasMenus: {
                        "cmAdd": function (t) {
                            var mLeft = $("#jqContextMenu").css("left"), mTop = $("#jqContextMenu").css("top");
                            var url = "/admin/flow/process";
                            $.post(url, {"flow_id": the_flow_id, "setleft": mLeft, "settop": mTop}, function (data) {

                                if (!data.status)
                                {
                                    mAlert(data.msg);
                                } else if (!_canvas.addProcess(data.info))//添加
                                {
                                    mAlert("添加失败");
                                }

                            }, 'json');

                        },
                        "cmSave": function (t) {
                            var processInfo = _canvas.getProcessInfo();//连接信息
                            var url = "/admin/flow/draw";
                            $.post(url, {"flow_id": the_flow_id, "process_info": processInfo}, function (data) {
                                mAlert(data.msg);
                            }, 'json');
                        },
                        //刷新
                        "cmRefresh": function (t) {
                            location.reload();//_canvas.refresh();
                        },
                        /*"cmPaste": function(t) {
                         var pasteId = _canvas.paste();//右键当前的ID
                         if(pasteId<=0)
                         {
                         alert("你未复制任何步骤");
                         return ;
                         }
                         alert("粘贴:" + pasteId);
                         },*/
                        "cmHelp": function (t) {
                            mAlert('<ul><li><a href="http://flowdesign.leipi.org/doc.html" target="_blank">流程设计器 开发文档</a></li><li><a href="http://formdesign.leipi.org/doc.html" target="_blank">表单设计器 开发文档</a></li><li><a href="http://formdesign.leipi.org/demo.html" target="_blank">表单设计器 示例DEMO</a></li></ul>', 20000);
                        }

                    }
                    /*步骤右键*/
                    , processMenus: {
                        /*
                         "pmBegin":function(t)
                         {
                         var activeId = _canvas.getActiveId();//右键当前的ID
                         alert("设为第一步:"+activeId);
                         },
                         "pmAddson":function(t)//添加子步骤
                         {
                         var activeId = _canvas.getActiveId();//右键当前的ID
                         },
                         "pmCopy":function(t)
                         {
                         //var activeId = _canvas.getActiveId();//右键当前的ID
                         _canvas.copy();//右键当前的ID
                         alert("复制成功");
                         },*/
                        "pmDelete": function (t)
                        {
                            if (confirm("你确定删除步骤吗？"))
                            {
                                var activeId = _canvas.getActiveId();//右键当前的ID
                                var url = "{:U('/Flowdesign/delete_process')}";
                                $.post(url, {"flow_id": the_flow_id, "process_id": activeId}, function (data) {
                                    if (data.status == 1)
                                    {
                                        //清除步骤
                                        //_canvas.delProcess(activeId);
                                        //清除连接   暂时先保存设计 + 刷新 完成
                                        var processInfo = _canvas.getProcessInfo();//连接信息
                                        var url = "{:U('/Flowdesign/save_canvas')}";
                                        $.post(url, {"flow_id": the_flow_id, "process_info": processInfo}, function (data) {
                                            location.reload();
                                        }, 'json');

                                    }
                                    mAlert(data.msg);
                                }, 'json');
                            }
                        },
                        "pmAttribute": function (t)
                        {
                            var activeId = _canvas.getActiveId();//右键当前的ID
                            var url = "/admin/flow/attribute?id="+activeId;
                            ajaxModal(url, function () {
                                //alert('加载完成执行')
                            });
                        },
                        "pmForm": function (t) {
                            var activeId = _canvas.getActiveId();//右键当前的ID
                            var url = "/admin/flow/attribute?op=form&id=" + activeId + "";
                            ajaxModal(url, function () {
                                //alert('加载完成执行')
                            });
                        },
                        "pmJudge": function (t) {
                            var activeId = _canvas.getActiveId();//右键当前的ID
                            var url = "/admin/flow/attribute?op=judge&id=" + activeId + "";
                            ajaxModal(url, function () {
                                //alert('加载完成执行')
                            });
                        },
                        "pmSetting": function (t) {
                            var activeId = _canvas.getActiveId();//右键当前的ID
                            var url = "/admin/flow/attribute?op=style&id=" + activeId + "";
                            ajaxModal(url, function () {
                                //alert('加载完成执行')
                            });
                        }
                    }
                    , fnRepeat: function () {
                        //alert("步骤连接重复1");//可使用 jquery ui 或其它方式提示
                        mAlert("步骤连接重复了，请重新连接");

                    }
                    , fnClick: function () {
                        var activeId = _canvas.getActiveId();
                        mAlert("查看步骤信息 " + activeId);
                    }
                    , fnDbClick: function () {
                        //和 pmAttribute 一样
                        var activeId = _canvas.getActiveId();//右键当前的ID
                        var url = "/admin/flow/attribute?id=" + activeId + "";
                        ajaxModal(url, function () {
                            //alert('加载完成执行')
                        });
                    }
                });




                /*保存*/
                $("#leipi_save").bind('click', function () {
                    var processInfo = _canvas.getProcessInfo();//连接信息
                    var url = "{:U('/Flowdesign/save_canvas')}";
                    $.post(url, {"flow_id": the_flow_id, "process_info": processInfo}, function (data) {
                        mAlert(data.msg);
                    }, 'json');
                });
                /*清除*/
                $("#leipi_clear").bind('click', function () {
                    if (_canvas.clear())
                    {
                        //alert("清空连接成功");
                        mAlert("清空连接成功，你可以重新连接");
                    } else
                    {
                        //alert("清空连接失败");
                        mAlert("清空连接失败");
                    }
                });
            });
        </script>
    </body>
</html>