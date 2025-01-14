<?php

namespace App\Http\Controllers;

use App\ReadModels\ReportQueryInterface;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(private readonly ReportQueryInterface $reportQuery)
    {
    }

    public function index(): View
    {
        $adviserId = auth()->id();

        return view('reports.index', ['reports' => $this->reportQuery->getAllByAdviser($adviserId)]);
    }
}
