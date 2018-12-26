<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'interest_rate',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function interestRate()
    {
        return $this->belongsTo(InterestRate::class);
    }

}
