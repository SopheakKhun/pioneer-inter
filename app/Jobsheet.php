<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Jobsheet
 *
 * @package App
 * @property string $booking
 * @property string $user
 * @property string $requesting
 * @property string $finish_date
 * @property string $diagnose
 * @property text $add_info
*/
class Jobsheet extends Model
{
    use SoftDeletes;

    protected $fillable = ['finish_date', 'diagnose', 'add_info', 'booking_id', 'user_id', 'requesting_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setBookingIdAttribute($input)
    {
        $this->attributes['booking_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRequestingIdAttribute($input)
    {
        $this->attributes['requesting_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFinishDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['finish_date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['finish_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getFinishDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function requesting()
    {
        return $this->belongsTo(Requesting::class, 'requesting_id')->withTrashed();
    }
    
}
