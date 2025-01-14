<?php

namespace App\ReadModels;

use App\DTO\Collection\ClientsWithLoanStatuses;

interface ClientQueryInterface
{
    public function all(): ClientsWithLoanStatuses;
}
