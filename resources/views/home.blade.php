@extends('layouts.app')

@section('content')

    <div class="row">
    @can('requesting_view')
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added requestings</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.requesting.fields.desc')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($requestings as $requesting)
                            <tr>
                               
                                <td>{{ $requesting->desc }} </td> 
                                <td>

                                    @can('requesting_view')
                                    <a href="{{ route('admin.requestings.show',[$requesting->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('requesting_edit')
                                    <a href="{{ route('admin.requestings.edit',[$requesting->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('requesting_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requestings.destroy', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>
    @endcan
    @can('booking_view')
 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added bookings</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.booking.fields.date')</th> 
                            <th> @lang('global.booking.fields.installer')</th> 
                            <th> @lang('global.booking.fields.model-no')</th> 
                            <th> @lang('global.booking.fields.serial-no')</th> 
                            <th> @lang('global.booking.fields.ladder-required')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($bookings as $booking)
                            <tr>
                               
                                <td>{{ $booking->date }} </td> 
                                <td>{{ $booking->installer }} </td> 
                                <td>{{ $booking->model_no }} </td> 
                                <td>{{ $booking->serial_no }} </td> 
                                <td>{{ $booking->ladder_required }} </td> 
                                <td>

                                    @can('booking_view')
                                    <a href="{{ route('admin.bookings.show',[$booking->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('booking_edit')
                                    <a href="{{ route('admin.bookings.edit',[$booking->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('booking_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.bookings.destroy', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>
@endcan
@can('jobsheet_view')
 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added jobsheets</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.jobsheet.fields.finish-date')</th> 
                            <th> @lang('global.jobsheet.fields.diagnose')</th> 
                            <th> @lang('global.jobsheet.fields.add-info')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($jobsheets as $jobsheet)
                            <tr>
                               
                                <td>{{ $jobsheet->finish_date }} </td> 
                                <td>{{ $jobsheet->diagnose }} </td> 
                                <td>{{ $jobsheet->add_info }} </td> 
                                <td>

                                    @can('jobsheet_view')
                                    <a href="{{ route('admin.jobsheets.show',[$jobsheet->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('jobsheet_edit')
                                    <a href="{{ route('admin.jobsheets.edit',[$jobsheet->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('jobsheet_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.jobsheets.destroy', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>
@endcan

    </div>
@endsection

