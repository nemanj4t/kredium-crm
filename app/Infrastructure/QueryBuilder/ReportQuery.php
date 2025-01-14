<?php

namespace App\Infrastructure\QueryBuilder;

use App\DTO\Collection\Reports;
use App\DTO\Report;
use App\ReadModels\ReportQueryInterface;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportQuery implements ReportQueryInterface
{
    public function getAllByAdviser(int $adviserId): Reports
    {
        $result = DB::table('loans')
            ->leftJoin('home_loans', 'home_loans.loan_id', '=', 'loans.id')
            ->leftJoin('cash_loans', 'cash_loans.loan_id', '=', 'loans.id')
            ->select('loans.type', 'loans.created_at', 'home_loans.down_payment_amount', 'home_loans.property_value', 'cash_loans.amount')
            ->where('loans.adviser_id', $adviserId)
            ->orderBy('loans.created_at', 'desc')
            ->get();

        if ($result->isEmpty()) {
            return new Reports();
        }

        return new Reports(
            ...array_map(fn (stdClass $row) => Report::fromStdObject($row), $result->toArray())
        );
    }
}
