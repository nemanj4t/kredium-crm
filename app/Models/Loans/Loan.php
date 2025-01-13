<?php

namespace App\Models\Loans;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    protected $fillable = ['client_id', 'advertiser_id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }

    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }
}
