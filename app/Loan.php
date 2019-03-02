<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'duration', 'repayment_frequency', 'interest_rate', 'fee', 'user_id',
    ];

    public function repayments()
    {
        return $this->hasMany('App\Repayment');
    }
}
