@extends('layouts.app')
@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD PERMISSION
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{!! route('admin.security.roles.index') !!}">MINISTRY LIST</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    {!! Form::open(['route' => ['admin.security.roles.store'], 'method' => 'POST']) !!}
                    @include('security.roles.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->
@stop
@section('scripts')
    <script src="{!! asset('plugins/autosize/autosize.js') !!}"></script>
    <script src="{!! asset('js/script.js') !!}"></script>
    <script>
        $(function () {
            autosize($('textarea.auto-growth'));
            $('#basic').prop("checked", true);
            $('#crud_form').addClass('hidden');
        });
        let app = new Vue({
            el: '#app',
            data: {
                permissionsSelected: []
            }
        });

    </script>
@stop