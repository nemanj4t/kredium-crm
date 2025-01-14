<?php

namespace App\DTO\Collection;

use App\DTO\ClientWithLoanStatuses;
use Iterator;

class ClientsWithLoanStatuses extends AbstractCollection implements Iterator
{
    private array $clients = [];

    public function __construct(ClientWithLoanStatuses ...$clients)
    {
        $this->clients = $clients;
    }

    public function current(): ClientWithLoanStatuses
    {
        return $this->clients[$this->index];
    }

    public function valid(): bool
    {
        return $this->index < count($this->clients);
    }
}
