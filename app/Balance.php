<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * Balance
 */
class Balance extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'balance', 'user_id'
    ];

    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
