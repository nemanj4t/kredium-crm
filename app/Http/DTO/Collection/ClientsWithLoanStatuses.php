<?php

namespace App\Http\DTO\Collection;

use App\Http\DTO\ClientWithLoanStatuses;
use Iterator;

class ClientsWithLoanStatuses implements Iterator
{
    private array $clients = [];
    private int $index = 0;

    public function __construct(ClientWithLoanStatuses ...$clients)
    {
        $this->clients = $clients;
    }

    public function current(): ClientWithLoanStatuses
    {
        return $this->clients[$this->index];
    }

    public function next(): void
    {
        $this->index += 1;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return $this->index < count($this->clients);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
