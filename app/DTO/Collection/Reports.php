<?php

namespace App\DTO\Collection;

use App\DTO\Report;
use App\Helpers\CSV\CsvParseable;
use Iterator;

class Reports extends AbstractCollection implements Iterator, CsvParseable
{
    private array $reports = [];

    public function __construct(Report ...$reports)
    {
        $this->reports = $reports;
    }

    public function current(): Report
    {
        return $this->reports[$this->index];
    }

    public function valid(): bool
    {
        return $this->index < count($this->reports);
    }

    public function parse(): array
    {
        return array_map(fn(Report $report) => $report->parse(), $this->reports);
    }
}
