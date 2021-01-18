<?php
declare(strict_types=1);

namespace thephpcc\cqrs;

use DateTimeInterface;

final class FlightDelayedEvent implements Event
{
    private string $flightNumber;

    private DateTimeInterface $eta;

    public function __construct(string $flightNumber, DateTimeInterface $eta)
    {
        $this->flightNumber = $flightNumber;
        $this->eta          = $eta;
    }

    public function flightNumber(): string
    {
        return $this->flightNumber;
    }

    public function eta(): DateTimeInterface
    {
        return $this->eta;
    }
}
