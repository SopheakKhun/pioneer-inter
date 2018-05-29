<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Requesting
 *
 * @package App
 * @property string $user
 * @property string $pref_day
 * @property string $desc
*/
class Requesting extends Model
{
    use SoftDeletes;

    protected $fillable = ['pref_day', 'desc', 'user_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
