@extends('layouts.app')
@section('content')
    <!-- Basic Card -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {!! $permission->name !!}
                        <small>{!! $permission->email !!}</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.security.permissions.create') !!}">Add</a></li>
                                <li><a href="{!! route('admin.security.permissions.edit', [$permission->id]) !!}">Edit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <p>
                        {!! $user->display_name !!}
                    </p>
                    <a href="{!! route('admin.security.permissions.edit', [$permission->id]) !!}"
                       class="btn btn-primary m-t-15 waves-effect">EDIT</a>
                    <a href="{!! route('admin.security.permissions.index') !!}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop