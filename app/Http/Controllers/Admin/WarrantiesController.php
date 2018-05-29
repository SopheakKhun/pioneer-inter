<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class WarrantiesController extends Controller
{
    public function index()
    {
        if (! Gate::allows('warranty_access')) {
            return abort(401);
        }
        return view('admin.warranties.index');
    }
}
