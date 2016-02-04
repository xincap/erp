@extends('layouts.app')

@section('content')
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.config.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.all.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/lang/zh-cn/zh-cn.js?{{$version}}"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/formdesign/leipi.formdesign.v4.js?{{$version}}"></script>
<!-- script start-->
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">流程设计器</a> <span class="divider">/</span></li>
            <li><a href="{:U('/demo')}">实例</a> <span class="divider">/</span></li>
            <li class="active"><if condition="empty($one)">添加<else/>编辑</if></li>
        </ol>
    </div>
    <div class="row">
        <form action="/admin/flow/design" method="post">
            <input type="hidden" value="{{$obj['id']}}" name="id">
            <p>
                <label>流程名称</label>
                <input type="text" class="span6" placeholder="必填项" name="flow_name" value="{{$obj['flow_name']}}">
            </p>
            <p>
                <label>选择表单</label>
                <select name="form_id">
                    <option value="5" selected="selected">小调查</option>
                </select>
            </p>
            <p>
                <label>流程描述</label>
                <textarea rows="4" class="span6" placeholder="简单描述一下也好呀" name="flow_desc">{{$obj['flow_desc']}}</textarea>
            </p>
            <button type="submit" name="submit_to_save" value="save" class="btn btn-success">确定保存</button>
        </form>
    </div>
</div>
@endsection
