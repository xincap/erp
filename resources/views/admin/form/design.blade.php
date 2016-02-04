@extends('layouts.app')

@section('content')
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.config.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.all.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/lang/zh-cn/zh-cn.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/formdesign/leipi.formdesign.v4.js?{{$version}}"></script>
<!-- script start-->  
<script type="text/javascript">

var leipiEditor = UE.getEditor('myFormDesign', {
    toolleipi: true, //是否显示，设计器的 toolbars
    textarea: 'design_content',
    //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
    toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|', 'fontfamily', 'fontsize', '|', 'indent', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'link', 'unlink', '|', 'simpleupload', 'horizontal', 'spechars', 'wordimage', '|', 'inserttable', 'deletetable', 'mergecells', 'splittocells', '|', 'template']],
    //focus时自动清空初始化时的内容
    //autoClearinitialContent:true,
    //关闭字数统计
    wordCount: false,
    //关闭elementPath
    elementPathEnabled: false,
    //默认的编辑区域高度
    initialFrameHeight: 300
            //更多其他参数，请参考ueditor.config.js中的配置项
});

var leipiFormDesign = {
    exec: function (method) {
        leipiEditor.execCommand(method);
    },
    fnCheckForm: function (type) {
        if (leipiEditor.queryCommandState('source'))
            leipiEditor.execCommand('source');//切换到编辑模式才提交，否则有bug


        if (leipiEditor.hasContents()) {
            leipiEditor.sync();       //同步内容

            var type_value, formid, formeditor;
            if (typeof type !== 'undefined') {
                type_value = type;
            }
            formeditor = leipiEditor.getContent();

            $("#button_save").text("submit...");
            //异步提交数据
            $.ajax({
                type: 'POST',
                url: '/admin/form/design',
                dataType: 'json',
                data: {"form_id": {{ $obj['id'] or '0' }}, "design_content": formeditor},
                success: function (data) {
                    $("#button_save").text("确定保存");
                    if (data.ret) {
                        window.location.href = '/admin/form/design?id='+data.ret;
                    }
                }
            });
        } else {
            alert('表单内容不能为空！')
            $('#submitbtn').button('reset');
            return false;
        }
    },
    fnReview: function () {
        if (leipiEditor.queryCommandState('source'))
            leipiEditor.execCommand('source');//切换到编辑模式才提交，否则有bug

        if (leipiEditor.hasContents()) {
            leipiEditor.sync();       //同步内容

            document.saveform.target = "mywin";
            window.open('', 'mywin', "menubar=0,toolbar=0,status=0,resizable=1,left=0,top=0,scrollbars=1,width=" + (screen.availWidth - 10) + ",height=" + (screen.availHeight - 50) + "\"");
            document.saveform.action = "/admin/form/preview";
            document.saveform.submit(); //提交表单
        } else {
            alert('表单内容不能为空！');
            return false;
        }
    }
};
</script>
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">表单设计器</a> <span class="divider">/</span></li>
            <li><a href="/demo.html">实例</a> <span class="divider">/</span></li>
            <li class="active">设计表单 [{{ $obj['form_name'] or '新建' }}]</li>
        </ol>
    </div>

    <form method="post" id="saveform" name="saveform" action="/admin/form/design?id={{ $obj['id'] or '0' }}" method="post">
        <input type="hidden" name="id" value="{{ $obj['id'] or '0' }}">
        {!! csrf_field() !!}
        <div class="row">
            <div class="well well-small">
                <span class="pull-right">
                    <!--a href="javascript:void(0);" class="btn btn-primary btn-small" onclick="leipiFormDesign.fnReview();">预览效果</a-->
                    <a href="javascript:void(0);" class="btn btn-success btn-small" id="button_save" onclick="leipiFormDesign.fnCheckForm('save');">确定保存</a>
                </span>

                <p>
                    一栏布局：<br /><br />
                    <button type="button" onclick="leipiFormDesign.exec('text');" class="btn btn-info">文本框</button>
                    <button type="button" onclick="leipiFormDesign.exec('textarea');" class="btn btn-info">多行文本</button>
                    <button type="button" onclick="leipiFormDesign.exec('select');" class="btn btn-info">下拉菜单</button>
                    <button type="button" onclick="leipiFormDesign.exec('radios');" class="btn btn-info">单选框</button>
                    <button type="button" onclick="leipiFormDesign.exec('checkboxs');" class="btn btn-info">复选框</button>
                    <button type="button" onclick="leipiFormDesign.exec('macros');" class="btn btn-info">宏控件</button>
                    <button type="button" onclick="leipiFormDesign.exec('progressbar');" class="btn btn-info">进度条</button>
                    <button type="button" onclick="leipiFormDesign.exec('qrcode');" class="btn btn-info">二维码</button>
                    <button type="button" onclick="leipiFormDesign.exec('listctrl');" class="btn btn-info">列表控件</button>
                    <!--button type="button" onclick="leipiFormDesign.exec('more');" class="btn btn-primary">一起参与...</button-->
                </p>
            </div>
        </div><!--end row-->   
        <div class="row">
            <script id="myFormDesign" type="text/plain" style="width:100%;">
                {!! $obj['content'] !!}
            </script>
        </div><!--end row-->

    </form>
</div>
@endsection
