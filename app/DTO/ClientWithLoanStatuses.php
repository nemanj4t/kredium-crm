<?php

namespace App\DTO;

readonly class ClientWithLoanStatuses
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public string|null $email,
        public string|null $phone,
        public bool $hasAppliedForCashLoan,
        public bool $hasAppliedForHomeLoan,
    ) {
    }
}
