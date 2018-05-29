@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.requesting.title')</h3>
    
    {!! Form::model($requesting, ['method' => 'PUT', 'route' => ['admin.requestings.update', $requesting->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.requesting.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pref_day', trans('global.requesting.fields.pref-day').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pref_day'))
                        <p class="help-block">
                            {{ $errors->first('pref_day') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('pref_day', 'Monday', false, []) !!}
                            Monday
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pref_day', 'Tuesday', false, []) !!}
                            Tueday
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pref_day', 'Wednesday', false, []) !!}
                            Wednesday
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pref_day', 'Thursday ', false, []) !!}
                            Thurday
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('pref_day', 'Friday', false, []) !!}
                            Firday
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('desc', trans('global.requesting.fields.desc').'', ['class' => 'control-label']) !!}
                    {!! Form::text('desc', old('desc'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('desc'))
                        <p class="help-block">
                            {{ $errors->first('desc') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@stop

