<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\Requesting::all() as $requesting) { 
           $crudFieldValue = $requesting->getOriginal('created_at'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $requesting->desc; 
           $prefix         = 'Request for '; 
           $suffix         = '!'; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.requestings.edit', $requesting->id)
           ]; 
        } 

        foreach (\App\Booking::all() as $booking) { 
           $crudFieldValue = $booking->getOriginal('date'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $booking->date; 
           $prefix         = 'Booking at '; 
           $suffix         = '!'; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.bookings.edit', $booking->id)
           ]; 
        } 

        foreach (\App\Jobsheet::all() as $jobsheet) { 
           $crudFieldValue = $jobsheet->getOriginal('finish_date'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $jobsheet->finish_date; 
           $prefix         = 'Finish at '; 
           $suffix         = '!'; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.jobsheets.edit', $jobsheet->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
