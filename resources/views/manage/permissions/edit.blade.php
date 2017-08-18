@extends('layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Add Permission</h3>
            <p class="text-muted m-b-2 font-13">Clearify lall thesl</p>
            {!! Form::model($permission, ['route' => ['admin.manage.permission.update', $permission->id], 'method' => 'patch']) !!}
            @include('manage.permissions.fields')
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script src="{!! asset('js/script.js') !!}"></script>
@stop