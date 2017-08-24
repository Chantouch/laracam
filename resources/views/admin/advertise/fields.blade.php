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
<div class="row">
    <div class="col-md-6">
        {!! Form::label('start_date', 'Start Date:') !!}
        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
            </div>
            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('end_date', 'End Date:') !!}
        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
            </div>
            @if ($errors->has('end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
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
<div class="row" v-if="advertise.adv_type == '7' || advertise.adv_type == '8'">
    <div class="col-md-12">
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
    </div>
</div>

<div class="row" v-else="">
    <div class="col-md-12">
        {!! Form::label('url', 'Provider Url:') !!}
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Enter your provider url']) !!}
            </div>
            @if ($errors->has('url'))
                <span class="help-block">
                    <strong>{{ $errors->first('url') }}</strong>
                </span>
            @endif
        </div>

        <!--Image of ads-->
        {!! Form::label('file', 'Image:') !!}
        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::file('file', ['class' => 'form-control']) !!}
            </div>
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>

    </div>
</div>

{{ Form::hidden('active', '0') }}
{!! Form::checkbox('active', '1', null, ['class' => 'filled-in', 'id'=> 'active']) !!}
<label for="active">Active</label>
<br>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.advertise.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>