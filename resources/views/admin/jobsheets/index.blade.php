@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.jobsheet.title')</h3>
    @can('jobsheet_create')
    <p>
        <a href="{{ route('admin.jobsheets.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.jobsheets.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.jobsheets.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($jobsheets) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>

                        <th>@lang('global.jobsheet.fields.booking')</th>
                        <th>@lang('global.booking.fields.model-no')</th>
                        <th>@lang('global.booking.fields.serial-no')</th>
                        <th>@lang('global.jobsheet.fields.user')</th>
                        <th>@lang('global.users.fields.lname')</th>
                        <th>@lang('global.users.fields.phone')</th>
                        <th>@lang('global.jobsheet.fields.requesting')</th>
                        <th>@lang('global.requesting.fields.desc')</th>
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
<td field-key='model_no'>{{ isset($jobsheet->booking) ? $jobsheet->booking->model_no : '' }}</td>
<td field-key='serial_no'>{{ isset($jobsheet->booking) ? $jobsheet->booking->serial_no : '' }}</td>
                                <td field-key='user'>{{ $jobsheet->user->name or '' }}</td>
<td field-key='lname'>{{ isset($jobsheet->user) ? $jobsheet->user->lname : '' }}</td>
<td field-key='phone'>{{ isset($jobsheet->user) ? $jobsheet->user->phone : '' }}</td>
                                <td field-key='requesting'>{{ $jobsheet->requesting->pref_day or '' }}</td>
<td field-key='desc'>{{ isset($jobsheet->requesting) ? $jobsheet->requesting->desc : '' }}</td>
                                <td field-key='finish_date'>{{ $jobsheet->finish_date }}</td>
                                <td field-key='diagnose'>{{ $jobsheet->diagnose }}</td>
                                <td field-key='add_info'>{!! $jobsheet->add_info !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.jobsheets.restore', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.jobsheets.perma_del', $jobsheet->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
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
@stop

