@extends('layouts.master')
@section('style')

@stop
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Category</h3>
            <p class="text-muted m-b-30">Easy to managing your category</p>
            {!! Form::model($category, ['route' => ['admin.ref.category.update', $category->id], 'method' => 'patch', 'files'=> true]) !!}
            @include('ref.category.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('plugins')
@stop

@section('script')
    <script>
//        $('#img_name').change(function () {
//            uploadPreview(this, 'img_preview');
//        });
    </script>
@stop