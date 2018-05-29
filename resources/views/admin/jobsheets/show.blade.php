@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.jobsheet.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.jobsheet.fields.booking')</th>
                            <td field-key='booking'>{{ $jobsheet->booking->date or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.model-no')</th>
                            <td field-key='model_no'>{{ isset($jobsheet->booking) ? $jobsheet->booking->model_no : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.booking.fields.serial-no')</th>
                            <td field-key='serial_no'>{{ isset($jobsheet->booking) ? $jobsheet->booking->serial_no : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobsheet.fields.user')</th>
                            <td field-key='user'>{{ $jobsheet->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.lname')</th>
                            <td field-key='lname'>{{ isset($jobsheet->user) ? $jobsheet->user->lname : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.phone')</th>
                            <td field-key='phone'>{{ isset($jobsheet->user) ? $jobsheet->user->phone : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobsheet.fields.requesting')</th>
                            <td field-key='requesting'>{{ $jobsheet->requesting->pref_day or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requesting.fields.desc')</th>
                            <td field-key='desc'>{{ isset($jobsheet->requesting) ? $jobsheet->requesting->desc : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobsheet.fields.finish-date')</th>
                            <td field-key='finish_date'>{{ $jobsheet->finish_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobsheet.fields.diagnose')</th>
                            <td field-key='diagnose'>{{ $jobsheet->diagnose }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.jobsheet.fields.add-info')</th>
                            <td field-key='add_info'>{!! $jobsheet->add_info !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.jobsheets.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
