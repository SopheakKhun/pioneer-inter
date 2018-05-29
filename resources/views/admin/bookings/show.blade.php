@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.booking.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.booking.fields.user')</th>
                            <td field-key='user'>{{ $booking->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.lname')</th>
                            <td field-key='lname'>{{ isset($booking->user) ? $booking->user->lname : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.phone')</th>
                            <td field-key='phone'>{{ isset($booking->user) ? $booking->user->phone : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.requesting')</th>
                            <td field-key='requesting'>{{ $booking->requesting->desc or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.date')</th>
                            <td field-key='date'>{{ $booking->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.installer')</th>
                            <td field-key='installer'>{{ $booking->installer }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.model-no')</th>
                            <td field-key='model_no'>{{ $booking->model_no }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.serial-no')</th>
                            <td field-key='serial_no'>{{ $booking->serial_no }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.type')</th>
                            <td field-key='type'>{{ $booking->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.ladder-required')</th>
                            <td field-key='ladder_required'>{{ Form::checkbox("ladder_required", 1, $booking->ladder_required == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.assing-to')</th>
                            <td field-key='assing_to'>{{ $booking->assing_to }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#jobsheet" aria-controls="jobsheet" role="tab" data-toggle="tab">Jobsheet</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="jobsheet">
<table class="table table-bordered table-striped {{ count($jobsheets) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.jobsheet.fields.booking')</th>
                        <th>@lang('global.jobsheet.fields.user')</th>
                        <th>@lang('global.jobsheet.fields.requesting')</th>
                        <th>@lang('global.jobsheet.fields.finish-date')</th>
                        <th>@lang('global.jobsheet.fields.diagnose')</th>
                        <th>@lang('global.jobsheet.fields.add-info')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($jobsheets) > 0)
            @foreach ($jobsheets as $jobsheet)
                <tr data-entry-id="{{ $jobsheet->id }}">
                    <td field-key='booking'>{{ $jobsheet->booking->date or '' }}</td>
                                <td field-key='user'>{{ $jobsheet->user->name or '' }}</td>
                                <td field-key='requesting'>{{ $jobsheet->requesting->pref_day or '' }}</td>
                                <td field-key='finish_date'>{{ $jobsheet->finish_date }}</td>
                                <td field-key='diagnose'>{{ $jobsheet->diagnose }}</td>
                                <td field-key='add_info'>{!! $jobsheet->add_info !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['jobsheets.restore', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['jobsheets.perma_del', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('jobsheets.show',[$jobsheet->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('jobsheets.edit',[$jobsheet->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['jobsheets.destroy', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.bookings.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
