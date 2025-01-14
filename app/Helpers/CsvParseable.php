<?php

namespace App\Helpers;

interface CsvParseable
{
    public function parse(): array;
}
