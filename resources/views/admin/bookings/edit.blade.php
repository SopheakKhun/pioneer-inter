@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.booking.title')</h3>
    
    {!! Form::model($booking, ['method' => 'PUT', 'route' => ['admin.bookings.update', $booking->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.booking.fields.user').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('requesting_id', trans('global.booking.fields.requesting').'', ['class' => 'control-label']) !!}
                    {!! Form::select('requesting_id', $requestings, old('requesting_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('requesting_id'))
                        <p class="help-block">
                            {{ $errors->first('requesting_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', trans('global.booking.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('installer', trans('global.booking.fields.installer').'', ['class' => 'control-label']) !!}
                    {!! Form::text('installer', old('installer'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('installer'))
                        <p class="help-block">
                            {{ $errors->first('installer') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('model_no', trans('global.booking.fields.model-no').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('model_no', old('model_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('model_no'))
                        <p class="help-block">
                            {{ $errors->first('model_no') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('serial_no', trans('global.booking.fields.serial-no').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('serial_no', old('serial_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('serial_no'))
                        <p class="help-block">
                            {{ $errors->first('serial_no') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('global.booking.fields.type').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('type', 'Domestic', false, []) !!}
                            Domestic
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Commercail', false, []) !!}
                            Commercail
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ladder_required', trans('global.booking.fields.ladder-required').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('ladder_required', 0) !!}
                    {!! Form::checkbox('ladder_required', 1, old('ladder_required', old('ladder_required')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ladder_required'))
                        <p class="help-block">
                            {{ $errors->first('ladder_required') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('assing_to', trans('global.booking.fields.assing-to').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('assing_to', old('assing_to'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('assing_to'))
                        <p class="help-block">
                            {{ $errors->first('assing_to') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop