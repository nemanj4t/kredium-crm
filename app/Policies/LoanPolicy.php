<?php

namespace App\Policies;

use App\Models\Loans\Loan;
use App\Models\User;

class LoanPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Loan $loan): bool
    {
        return $user->id === $loan->adviser_id;
    }
}
