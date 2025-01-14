<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;

class HomeLoan extends Model
{
    protected $fillable = ['loan_id', 'down_payment_amount', 'property_value'];
}
