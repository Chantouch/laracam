{!! Form::label('provider_name', 'Provider Name:') !!}
<div class="form-group{{ $errors->has('provider_name') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('provider_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your provider name']) !!}
    </div>
    @if ($errors->has('provider_name'))
        <span class="help-block">
            <strong>{{ $errors->first('provider_name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('advertise_type_id', 'Ads Type:') !!}
<div class="form-group{{ $errors->has('advertise_type_id') ? ' has-error' : '' }}">
    <div class="form-line">
        <input type="hidden" name="advertise_type_id" :value="advertise.adv_type">
        <select id="advertise_type_id" v-model="advertise.adv_type" class="form-control">
            <option value="">---Select---</option>
            <option v-for="ads in advertise_type" :value="ads.id">@{{ ads.name }}</option>
        </select>
    </div>
    @if ($errors->has('advertise_type_id'))
        <span class="help-block">
            <strong>{{ $errors->first('advertise_type_id') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('tracking_code_large', 'Tracking code (Large format):') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('tracking_code_large', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code large']) !!}
    </div>
    @if ($errors->has('tracking_code_large'))
        <span class="help-block">
            <strong>{{ $errors->first('tracking_code_large') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('tracking_code_tablet', 'Tracking code (Tablet format):') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('tracking_code_tablet', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code tablet']) !!}
    </div>
    @if ($errors->has('tracking_code_tablet'))
        <span class="help-block">
            <strong>{{ $errors->first('tracking_code_tablet') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('tracking_code_mobile', 'Tracking code (Mobile format):') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('tracking_code_mobile', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code mobile']) !!}
    </div>
    @if ($errors->has('tracking_code_mobile'))
        <span class="help-block">
            <strong>{{ $errors->first('tracking_code_mobile') }}</strong>
        </span>
    @endif
</div>

{{ Form::hidden('active', '0') }}
{!! Form::checkbox('active', '1', null, ['class' => 'filled-in', 'id'=> 'active']) !!}
<label for="active">Active</label>
<br>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.advertise.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>