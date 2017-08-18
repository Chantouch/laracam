@if(count($categories)>1)
    {!! Form::label('parent_id', 'Category Level:') !!}
    <div class="form-group">
        <div class="form-line">
            {!! Form::select('parent_id',$categories , null, ['class' => 'form-control show-tick', 'data-live-search' => 'true', 'placeholder' => 'Select category']) !!}
        </div>
    </div>
@endif

{!! Form::label('name', 'Category Name:') !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your category name']) !!}
    </div>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('description', 'Category Description:') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter your category description']) !!}
    </div>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('tags', 'Tags:') !!}
<div class="form-group tagsinput-area">
    <div class="form-line">
        @if(isset($category))
            {!! Form::text('tags', $category->tagList(), ['class' => 'form-control', 'placeholder' => 'Enter your product tag', 'data-role'=>'tagsinput', 'id'=>'tags']) !!}
        @else
            {!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Enter your product tag', 'data-role'=>'tagsinput', 'id'=>'tags']) !!}
        @endif
    </div>
    @if ($errors->has('tags'))
        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    @endif
</div>

{{ Form::hidden('status', '0') }}
{!! Form::checkbox('status', '1', null, ['class' => 'filled-in', 'id'=> 'active']) !!}
<label for="active">Active</label>
<br>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.manage.categories.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>