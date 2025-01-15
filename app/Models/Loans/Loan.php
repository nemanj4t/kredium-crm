<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    protected $fillable = ['type', 'client_id', 'adviser_id'];

    public function homeProduct(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }

    public function cashProduct(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }
}
