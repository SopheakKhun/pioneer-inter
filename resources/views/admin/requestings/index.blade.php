@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.requesting.title')</h3>
    @can('requesting_create')
    <p>
        <a href="{{ route('admin.requestings.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.requestings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.requestings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($requestings) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        <th>@lang('global.requesting.fields.user')</th>
                        <th>@lang('global.users.fields.lname')</th>
                        <th>@lang('global.users.fields.phone')</th>
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
                                <td field-key='lname'>{{ isset($requesting->user) ? $requesting->user->lname : '' }}</td>
                                <td field-key='phone'>{{ isset($requesting->user) ? $requesting->user->phone : '' }}</td>
                                <td field-key='pref_day'>{{ $requesting->pref_day }}</td>
                                <td field-key='desc'>{{ $requesting->desc }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requestings.restore', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requestings.perma_del', $requesting->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
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
    </div>
@stop

