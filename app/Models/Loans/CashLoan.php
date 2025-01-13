<?php

namespace App\Models\Loans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashLoan extends Model
{
    protected $fillable = ['loan_id', 'value'];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
