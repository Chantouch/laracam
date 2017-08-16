@extends('layouts.app')
@section('content')
    <!-- Basic Card -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3 class="title">{{$role->display_name}}<small class="m-l-25"><em>({{$role->name}})</em></small></h3>
                    <h5>{{$role->description}}</h5>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.security.roles.create') !!}">Add</a></li>
                                <li><a href="{!! route('admin.security.roles.edit', [$role->id]) !!}">Edit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <h3 class="title">Permissions:</h3>
                                <ul>
                                    @foreach ($role->permissions as $r)
                                        <li>{{$r->display_name}} <em class="m-l-15">({{$r->description}})</em></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                    <a href="{!! route('admin.security.roles.edit', [$role->id]) !!}"
                       class="btn btn-primary m-t-15 waves-effect">EDIT</a>
                    <a href="{!! route('admin.security.roles.index') !!}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                </div>
            </div>
        </div>
    </div>
@stop