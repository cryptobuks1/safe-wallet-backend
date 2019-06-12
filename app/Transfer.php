<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Transaction;

class Transfer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'beneficiary_id', 'commentary_id', 'source_id', 'destination_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    public function source()
    {
        return $this->belongsTo(Transaction::class, 'source_id');
    }

    public function destination()
    {
        return $this->belongsTo(Transaction::class, 'destination_id');
    }
}
