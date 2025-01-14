<?php

namespace App\Models;

use App\Http\Enums\LoanTypeEnum;
use App\Models\Loans\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

    public function cashLoan(): HasOne
    {
        return $this->hasOne(Loan::class)->where('type', LoanTypeEnum::CASH->value);
    }

    public function homeLoan(): HasOne
    {
        return $this->hasOne(Loan::class)->where('type', LoanTypeEnum::HOME->value);
    }
}
