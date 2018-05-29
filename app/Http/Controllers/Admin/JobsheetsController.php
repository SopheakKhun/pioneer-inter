<?php

namespace App\Http\Controllers\Admin;

use App\Jobsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobsheetsRequest;
use App\Http\Requests\Admin\UpdateJobsheetsRequest;

class JobsheetsController extends Controller
{
    /**
     * Display a listing of Jobsheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('jobsheet_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('jobsheet_delete')) {
                return abort(401);
            }
            $jobsheets = Jobsheet::onlyTrashed()->get();
        } else {
            $jobsheets = Jobsheet::all();
        }

        return view('admin.jobsheets.index', compact('jobsheets'));
    }

    /**
     * Show the form for creating new Jobsheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('jobsheet_create')) {
            return abort(401);
        }
        
        $bookings = \App\Booking::get()->pluck('date', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $requestings = \App\Requesting::get()->pluck('pref_day', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.jobsheets.create', compact('bookings', 'users', 'requestings'));
    }

    /**
     * Store a newly created Jobsheet in storage.
     *
     * @param  \App\Http\Requests\StoreJobsheetsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobsheetsRequest $request)
    {
        if (! Gate::allows('jobsheet_create')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::create($request->all());



        return redirect()->route('admin.jobsheets.index');
    }


    /**
     * Show the form for editing Jobsheet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('jobsheet_edit')) {
            return abort(401);
        }
        
        $bookings = \App\Booking::get()->pluck('date', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $requestings = \App\Requesting::get()->pluck('pref_day', 'id')->prepend(trans('global.app_please_select'), '');

        $jobsheet = Jobsheet::findOrFail($id);

        return view('admin.jobsheets.edit', compact('jobsheet', 'bookings', 'users', 'requestings'));
    }

    /**
     * Update Jobsheet in storage.
     *
     * @param  \App\Http\Requests\UpdateJobsheetsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobsheetsRequest $request, $id)
    {
        if (! Gate::allows('jobsheet_edit')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::findOrFail($id);
        $jobsheet->update($request->all());



        return redirect()->route('admin.jobsheets.index');
    }


    /**
     * Display Jobsheet.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('jobsheet_view')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::findOrFail($id);

        return view('admin.jobsheets.show', compact('jobsheet'));
    }


    /**
     * Remove Jobsheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('jobsheet_delete')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::findOrFail($id);
        $jobsheet->delete();

        return redirect()->route('admin.jobsheets.index');
    }

    /**
     * Delete all selected Jobsheet at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('jobsheet_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Jobsheet::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Jobsheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('jobsheet_delete')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::onlyTrashed()->findOrFail($id);
        $jobsheet->restore();

        return redirect()->route('admin.jobsheets.index');
    }

    /**
     * Permanently delete Jobsheet from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('jobsheet_delete')) {
            return abort(401);
        }
        $jobsheet = Jobsheet::onlyTrashed()->findOrFail($id);
        $jobsheet->forceDelete();

        return redirect()->route('admin.jobsheets.index');
    }
}
