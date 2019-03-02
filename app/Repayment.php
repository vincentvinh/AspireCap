<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time_to_pay', 'amount_to_pay', 'loan_id',
    ];
    public function Loan()
    {
        return $this->belongsTo('App\Loan');
    }
}
