@extends('layouts.app')
@section('style')
    <!-- Bootstrap Select Css -->
    <link href="{!! asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet"/>
    <!-- Bootstrap Tagsinput Css -->
    <link href="{!! asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" rel="stylesheet">
@stop
@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD CATEGORY
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.manage.categories.index') !!}">CATEGORY LIST</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::open(['route' => ['admin.manage.categories.store'], 'method' => 'POST', 'files'=> true]) !!}
                    @include('manage.categories.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->
@stop

@section('plugins')
    <!-- Select Plugin Js -->
    <script src="{!! asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') !!}"></script>
    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{!! asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}"></script>
@stop


@section('script')
    <script>
//        $('#img_name').change(function () {
//            uploadPreview(this, 'img_preview');
//        });
    </script>
@stop