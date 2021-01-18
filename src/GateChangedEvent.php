<?php
declare(strict_types=1);

namespace thephpcc\cqrs;

final class GateChangedEvent implements Event
{
    private string $flightNumber;

    private string $gate;

    public function __construct(string $flightNumber, string $gate)
    {
        $this->flightNumber = $flightNumber;
        $this->gate = $gate;
    }

    public function flightNumber(): string
    {
        return $this->flightNumber;
    }

    public function gate(): string
    {
        return $this->gate;
    }
}
