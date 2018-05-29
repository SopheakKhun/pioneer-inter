@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('global.app_register')</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">@lang('global.app_name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">

                                <label for="lname" class="col-md-4 control-label">@lang('global.app_lname')</label>
                                    
                                    <div class="col-md-6">

                                        <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus> 
                                        
                                        @if ($errors->has('lname'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('lname') }}</strong>

                                        </span> 
                                        @endif

                                        </div>

                                    </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('global.app_email')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">@lang('global.app_address')</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus> 
                                    
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span> 
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('suburb') ? ' has-error' : '' }}">
                                <label for="suburb" class="col-md-4 control-label">@lang('global.app_suburb')</label>

                                <div class="col-md-6">
                                    <input id="suburb" type="text" class="form-control" name="suburb" value="{{ old('suburb') }}"required autofocus> 
                                
                                    @if ($errors->has('suburb'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('suburb') }}</strong>
                                    </span> 
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="suburb" class="col-md-4 control-label">@lang('global.app_state')</label>

                                <div class="col-md-6">
                                    <select id="state" class="form-control" name="state" required autofocus>
                                        <option value="NSW">NSW</option>
                                        <option value="ACT">ACT</option>
                                        <option value="QLD">QLD</option>
                                        <option value="VIC">VIC</option>
                                        <option value="SA">SA</option>
                                        <option value="WA">WA</option>
                                        <option value="NT">NT</option>
                                        <option value="TAS">TAS</option>
                                    </select> 

                                    @if ($errors->has('state'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('state') }}</strong>
                                    </span> 
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                                <label for="suburb" class="col-md-4 control-label">@lang('global.app_postcode')</label>

                                <div class="col-md-6">

                                <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}"required autofocus>
                                    @if ($errors->has('postcode'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                     @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="suburb" class="col-md-4 control-label">@lang('global.app_phone')</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus> 
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                    </span> 
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">@lang('global.app_password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">@lang('global.app_confirm_password')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('global.app_register')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
