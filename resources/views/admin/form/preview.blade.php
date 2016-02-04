@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">表单</a> <span class="divider">/</span></li>
            <li class="active">{{$obj['form_name']}} [{{$obj['form_desc']}}]</li>
        </ol>
    </div>

    <div class="row ">
        {!!$text!!}
    </div>
</div>
@endsection
