<?php

namespace App\ReadModels;

use App\Http\DTO\Collection\ClientsWithLoanStatuses;

interface ClientQueryInterface
{
    public function all(): ClientsWithLoanStatuses;
}
