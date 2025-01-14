<?php

namespace App\Infrastructure\QueryBuilder;

use App\DTO\ClientWithLoanStatuses;
use App\DTO\Collection\ClientsWithLoanStatuses;
use App\Http\Enums\LoanTypeEnum;
use App\ReadModels\ClientQueryInterface;
use Illuminate\Support\Facades\DB;
use stdClass;

class ClientQuery implements ClientQueryInterface
{

    public function all(): ClientsWithLoanStatuses
    {
        $cashLoanType = LoanTypeEnum::CASH->value;
        $homeLoanType = LoanTypeEnum::HOME->value;

        $result = DB::table('clients')
            ->leftJoin('loans', 'loans.client_id', '=', 'clients.id')
            ->select('clients.*', DB::raw("
                sum(case when loans.type = '$cashLoanType' then 1 else 0 end) AS cash_loan_count,
                sum(case when loans.type = '$homeLoanType' then 1 else 0 end) AS home_loan_count
            "))
            ->groupBy('clients.id')
            ->get();

        if ($result->isEmpty()) {
            return new ClientsWithLoanStatuses();
        }

        return new ClientsWithLoanStatuses(
            ...array_map(fn(stdClass $row) => new ClientWithLoanStatuses(
                $row->id,
                $row->first_name,
                $row->last_name,
                $row->email,
                $row->phone,
                $row->cash_loan_count > 0,
                $row->home_loan_count > 0,
            ), $result->toArray())
        );
    }
}
