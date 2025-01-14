<?php

namespace App\DTO\Collection;

use App\DTO\Report;
use Iterator;

class Reports extends AbstractCollection implements Iterator
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
}
