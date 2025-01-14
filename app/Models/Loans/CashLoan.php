<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class CashLoan extends Model
{
    protected $fillable = ['loan_id', 'amount'];
}
