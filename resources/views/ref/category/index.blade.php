@extends('layouts.master')
@section('content')
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Category</h3>
            <p class="text-muted m-b-30">Easy to managing your category</p>
            @include('ref.category.table')
        </div>
    </div>
@stop