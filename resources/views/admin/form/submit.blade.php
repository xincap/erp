@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">表单</a> <span class="divider">/</span></li>
            <li class="active">{{$obj['form_name']}} [{{$obj['form_desc']}}]</li>
        </ol>
    </div>

    <div class="row">
        <form action="/admin/form/submit" method="post">
            <input type="hidden" value="{{$obj['id']}}" name="form_id">
            {!! csrf_field() !!}
            <p>
                {!! $text !!}
            </p>
            <button type="submit" name="submit_to_save" value="save" class="btn btn-success">确定保存</button>
        </form>
    </div>
</div>
@endsection
