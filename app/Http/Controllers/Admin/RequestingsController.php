<?php

namespace App\Http\Controllers\Admin;

use App\Requesting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequestingsRequest;
use App\Http\Requests\Admin\UpdateRequestingsRequest;

class RequestingsController extends Controller
{
    /**
     * Display a listing of Requesting.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        if (! Gate::allows('requesting_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('requesting_delete')) {
                return abort(401);
            }
            $requestings = Requesting::onlyTrashed()->get();
        } else {
            $requestings = Requesting::all();
        }

        return view('admin.requestings.index', compact('requestings'));
    }

    /**
     * Show the form for creating new Requesting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('requesting_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        
        return view('admin.requestings.create', compact('users'));
    }

    /**
     * Store a newly created Requesting in storage.
     *
     * @param  \App\Http\Requests\StoreRequestingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestingsRequest $request)
    {
        if (! Gate::allows('requesting_create')) {
            return abort(401);
        }
        $requesting = Requesting::create($request->all());



        return redirect()->route('admin.requestings.index');
    }


    /**
     * Show the form for editing Requesting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('requesting_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $requesting = Requesting::findOrFail($id);

        return view('admin.requestings.edit', compact('requesting', 'users'));
    }

    /**
     * Update Requesting in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestingsRequest $request, $id)
    {
        if (! Gate::allows('requesting_edit')) {
            return abort(401);
        }
        $requesting = Requesting::findOrFail($id);
        $requesting->update($request->all());



        return redirect()->route('admin.requestings.index');
    }


    /**
     * Display Requesting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('requesting_view')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$bookings = \App\Booking::where('requesting_id', $id)->get();$jobsheets = \App\Jobsheet::where('requesting_id', $id)->get();

        $requesting = Requesting::findOrFail($id);

        return view('admin.requestings.show', compact('requesting', 'bookings', 'jobsheets'));
    }


    /**
     * Remove Requesting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('requesting_delete')) {
            return abort(401);
        }
        $requesting = Requesting::findOrFail($id);
        $requesting->delete();

        return redirect()->route('admin.requestings.index');
    }

    /**
     * Delete all selected Requesting at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('requesting_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Requesting::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Requesting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('requesting_delete')) {
            return abort(401);
        }
        $requesting = Requesting::onlyTrashed()->findOrFail($id);
        $requesting->restore();

        return redirect()->route('admin.requestings.index');
    }

    /**
     * Permanently delete Requesting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('requesting_delete')) {
            return abort(401);
        }
        $requesting = Requesting::onlyTrashed()->findOrFail($id);
        $requesting->forceDelete();

        return redirect()->route('admin.requestings.index');
    }
}
