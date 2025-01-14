<?php

namespace App\Helpers\CSV;

interface CsvParseable
{
    public function parse(): array;
}
