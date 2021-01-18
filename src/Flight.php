<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

use DateTimeImmutable;

class Flight
{
    private DateTimeImmutable $date;

    private string $number;

    private string $destination;

    private $isCancelled = false;

    private string $gate;

    public function __construct(
        DateTimeImmutable $date,
        string $number,
        string $destination,
        string $gate
    ) {
        $this->date        = $date;
        $this->number      = $number;
        $this->destination = $destination;
        $this->gate        = $gate;
    }

    public function cancel(): Flight
    {
        $flight              = new Flight($this->date, $this->number, $this->destination, $this->gate);
        $flight->isCancelled = true;

        return $flight;
    }

    public function date(): DateTimeImmutable
    {
        return $this->date;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function destination(): string
    {
        return $this->destination;
    }

    public function isCancelled(): bool
    {
        return $this->isCancelled;
    }

    public function gate(): string
    {
        return $this->gate;
    }

    public function changeGate(string $gate): self
    {
        return new Flight($this->date, $this->number, $this->destination, $gate);
    }
}
