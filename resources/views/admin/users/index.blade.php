@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.lname')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.address')</th>
                        <th>@lang('global.users.fields.suburb')</th>
                        <th>@lang('global.users.fields.state')</th>
                        <th>@lang('global.users.fields.postcode')</th>
                        <th>@lang('global.users.fields.phone')</th>
                        <th>@lang('global.users.fields.role')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='lname'>{{ $user->lname }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='address'>{{ $user->address }}</td>
                                <td field-key='suburb'>{{ $user->suburb }}</td>
                                <td field-key='state'>{{ $user->state }}</td>
                                <td field-key='postcode'>{{ $user->postcode }}</td>
                                <td field-key='phone'>{{ $user->phone }}</td>
                                <td field-key='role'>
                                    @foreach ($user->role as $singleRole)
                                        <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

