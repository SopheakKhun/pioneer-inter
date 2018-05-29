@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.lname')</th>
                            <td field-key='lname'>{{ $user->lname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.address')</th>
                            <td field-key='address'>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.suburb')</th>
                            <td field-key='suburb'>{{ $user->suburb }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.state')</th>
                            <td field-key='state'>{{ $user->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.postcode')</th>
                            <td field-key='postcode'>{{ $user->postcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#requesting" aria-controls="requesting" role="tab" data-toggle="tab">Request</a></li>
<li role="presentation" class=""><a href="#booking" aria-controls="booking" role="tab" data-toggle="tab">Booking</a></li>
<li role="presentation" class=""><a href="#jobsheet" aria-controls="jobsheet" role="tab" data-toggle="tab">Jobsheet</a></li>
<li role="presentation" class=""><a href="#internal_notifications" aria-controls="internal_notifications" role="tab" data-toggle="tab">Notifications</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="requesting">
<table class="table table-bordered table-striped {{ count($requestings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.requesting.fields.user')</th>
                        <th>@lang('global.requesting.fields.pref-day')</th>
                        <th>@lang('global.requesting.fields.desc')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($requestings) > 0)
            @foreach ($requestings as $requesting)
                <tr data-entry-id="{{ $requesting->id }}">
                    <td field-key='user'>{{ $requesting->user->name or '' }}</td>
                                <td field-key='pref_day'>{{ $requesting->pref_day }}</td>
                                <td field-key='desc'>{{ $requesting->desc }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['requestings.restore', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['requestings.perma_del', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('requestings.show',[$requesting->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('requestings.edit',[$requesting->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['requestings.destroy', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="booking">
<table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.booking.fields.user')</th>
                        <th>@lang('global.booking.fields.requesting')</th>
                        <th>@lang('global.booking.fields.date')</th>
                        <th>@lang('global.booking.fields.installer')</th>
                        <th>@lang('global.booking.fields.model-no')</th>
                        <th>@lang('global.booking.fields.serial-no')</th>
                        <th>@lang('global.booking.fields.type')</th>
                        <th>@lang('global.booking.fields.ladder-required')</th>
                        <th>@lang('global.booking.fields.assing-to')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($bookings) > 0)
            @foreach ($bookings as $booking)
                <tr data-entry-id="{{ $booking->id }}">
                    <td field-key='user'>{{ $booking->user->name or '' }}</td>
                                <td field-key='requesting'>{{ $booking->requesting->desc or '' }}</td>
                                <td field-key='date'>{{ $booking->date }}</td>
                                <td field-key='installer'>{{ $booking->installer }}</td>
                                <td field-key='model_no'>{{ $booking->model_no }}</td>
                                <td field-key='serial_no'>{{ $booking->serial_no }}</td>
                                <td field-key='type'>{{ $booking->type }}</td>
                                <td field-key='ladder_required'>{{ Form::checkbox("ladder_required", 1, $booking->ladder_required == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='assing_to'>{{ $booking->assing_to }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bookings.restore', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bookings.perma_del', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('bookings.show',[$booking->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('bookings.edit',[$booking->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['bookings.destroy', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="jobsheet">
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
<div role="tabpanel" class="tab-pane " id="internal_notifications">
<table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($internal_notifications) > 0)
            @foreach ($internal_notifications as $internal_notification)
                <tr data-entry-id="{{ $internal_notification->id }}">
                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['internal_notifications.destroy', $internal_notification->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
