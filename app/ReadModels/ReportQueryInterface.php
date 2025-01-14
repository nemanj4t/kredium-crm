<?php

namespace App\ReadModels;

use App\DTO\Collection\Reports;

interface ReportQueryInterface
{
    public function getAllByAdviser(int $adviserId): Reports;
}
