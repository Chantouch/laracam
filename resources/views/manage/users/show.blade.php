@extends('layouts.master')
@section('content')
    <!-- Basic Card -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! $user->name !!}
                        <small>{!! $user->email !!}</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.manage.user.create') !!}">Add</a></li>
                                <li><a href="{!! route('admin.manage.user.edit', [$user->id]) !!}">Edit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <p>
                        {!! $user->email !!}
                    </p>
                    <ul>
                        {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}}
                        @foreach ($user->roles as $role)
                            <li>{{$role->display_name}} ({{$role->description}})</li>
                        @endforeach
                    </ul>
                    <a href="{!! route('admin.manage.user.edit', [$user->id]) !!}"
                       class="btn btn-primary m-t-15 waves-effect">EDIT</a>
                    <a href="{!! route('admin.manage.user.index') !!}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop