@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.booking.title')</h3>
    @can('booking_create')
    <p>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.bookings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.bookings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        

                        <th>@lang('global.booking.fields.user')</th>
                        <th>@lang('global.users.fields.lname')</th>
                        <th>@lang('global.users.fields.phone')</th>
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
<td field-key='lname'>{{ isset($booking->user) ? $booking->user->lname : '' }}</td>
<td field-key='phone'>{{ isset($booking->user) ? $booking->user->phone : '' }}</td>
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
                                        'route' => ['admin.bookings.restore', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.bookings.perma_del', $booking->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
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
    </div>
@stop

