<?php

namespace App\DTO\Collection;

use Iterator;

abstract class AbstractCollection implements Iterator
{
    protected int $index = 0;

    abstract public function current(): mixed;
    abstract public function valid(): bool;

    public function next(): void
    {
        $this->index += 1;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
