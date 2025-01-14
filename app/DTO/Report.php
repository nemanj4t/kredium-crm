<?php

namespace App\DTO;

use App\Helpers\CSV\CsvParseable;
use App\Http\Enums\LoanTypeEnum;
use stdClass;

class Report implements CsvParseable
{
    private function __construct(
        public string $loanType,
        public float $value,
        public string $createdAt,
    ) {
    }

    public static function fromStdObject(stdClass $object): self
    {
        $type = LoanTypeEnum::tryFrom($object->type);

        [$loanType, $value] = match ($type) {
            LoanTypeEnum::CASH => ['Cash Loan', $object->amount],
            LoanTypeEnum::HOME => ['Home Loan', $object->property_value - $object->down_payment_amount],
        };

        return new self($loanType, $value, $object->created_at);
    }

    public function parse(): array
    {
        return [$this->loanType, $this->value, $this->createdAt];
    }
}
