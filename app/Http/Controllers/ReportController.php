<?php

namespace App\Http\Controllers;

use App\Helpers\CSV\CsvBuilder;
use App\ReadModels\ReportQueryInterface;
use App\Service\CsvService;
use DateTime;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportQueryInterface $reportQuery,
        private readonly CsvService $csvService
    ) {
    }

    public function index(): View
    {
        $adviserId = auth()->id();

        return view('reports.index', ['reports' => $this->reportQuery->getAllByAdviser($adviserId)]);
    }

    public function export(): StreamedResponse
    {
        $adviserId = auth()->id();

        $reports = $this->reportQuery->getAllByAdviser($adviserId);

        $data = CsvBuilder::headers(['product_type', 'product_value', 'created_at'])
            ->rows($reports)
            ->build();

        return $this->csvService->export(
            new DateTime()->format('Y-m-d_H-i-s') . '.csv',
            $data
        );
    }
}
