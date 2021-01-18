<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

class DepartureInformationBoard
{
    /**
     * @var Flight[]
     */
    private array $flights = [];

    private array $remarks = [];

    private array $gateChanges = [];

    public function displayFlight(Flight $flight): void
    {
        $this->flights[$flight->number()] = $flight;
        $this->remarks[$flight->number()] = 'on time';
    }

    public function cancelFlight(string $flightNumber): void
    {
        $this->remarks[$flightNumber] = 'cancelled';
    }

    public function asString(): string
    {
        $lines = [];

        foreach ($this->flights as $flight) {
            $columns   = [];
            $columns[] = $flight->date()->format('H:i');
            $columns[] = $flight->number();
            $columns[] = $flight->destination();
            $columns[] = $flight->gate();
            $columns[] = isset($this->remarks[$flight->number()])
                ? $this->remarks[$flight->number()]
                : '';
            $columns[] = isset($this->gateChanges[$flight->number()])
                ? 'Gate change: ' . $this->gateChanges[$flight->number()]
                : '';

            $lines[] = implode(' | ', array_map(fn(string $s) => str_pad($s, 10, ' ', STR_PAD_LEFT), $columns));
        }

        return implode(PHP_EOL, $lines);
    }

    public function changeGate(string $flightNumber, string $gate): void
    {
        $this->gateChanges[$flightNumber] = $gate;
    }

    public function startBoarding(string $flightNumber): void
    {
        $this->remarks[$flightNumber] = 'boarding';
    }
}
