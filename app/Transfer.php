<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Transaction;

class Transfer extends Model
{

    protected $fillable = [ 'user_id', 'beneficiary_id', 'commentary_id', 'transaction_id'];

    public function user ()
    {
        $this->belongsTo(User::class);
    }

    public function beneficiary ()
    {
        $this->belongsTo(User::class, 'beneficiary_id');
    }

    public function transaction()
    {
        $this->belongsTo(Transaction::class);
    }
    
}
