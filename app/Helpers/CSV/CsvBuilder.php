<?php

namespace App\Helpers\CSV;

class CsvBuilder
{
    private array $headers;
    private array $rows;

    private function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    public static function headers(array $headers): self
    {
        return new self($headers);
    }

    public function rows(CsvParseable $data): self
    {
        $this->rows = $data->parse();

        return $this;
    }

    public function build(): array
    {
        return [$this->headers, ...$this->rows];
    }
}
