<?php
declare(strict_types=1);

namespace thephpcc\cqrs;

final class BoardingStartedEvent implements Event
{
    private string $flightNumber;

    public function __construct(string $flightNumber)
    {
        $this->flightNumber = $flightNumber;
    }

    public function flightNumber(): string
    {
        return $this->flightNumber;
    }
}
