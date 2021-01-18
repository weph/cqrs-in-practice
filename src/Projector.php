<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

use thephpcc\cqrs\BoardingStartedEvent;
use thephpcc\cqrs\Event;
use thephpcc\cqrs\FlightCancelledEvent;
use thephpcc\cqrs\FlightScheduledEvent;
use thephpcc\cqrs\GateChangedEvent;

class Projector
{
    private DepartureInformationBoard $board;

    public function __construct(DepartureInformationBoard $board)
    {
        $this->board = $board;
    }

    public function handle(Event $event): void
    {
        switch (get_class($event)) {

            case FlightScheduledEvent::class:
                assert($event instanceof FlightScheduledEvent);
                $this->handleFlightScheduledEvent($event);
                break;

            case FlightCancelledEvent::class:
                assert($event instanceof FlightCancelledEvent);
                $this->handleFlightCancelledEvent($event);
                break;

            case GateChangedEvent::class:
                assert($event instanceof GateChangedEvent);
                $this->handleGateChangedEvent($event);
                break;

            case BoardingStartedEvent::class:
                assert($event instanceof BoardingStartedEvent);
                $this->handleBoardingStartedEvent($event);
                break;
        }
    }

    private function handleFlightScheduledEvent(FlightScheduledEvent $event): void
    {
        $this->board->displayFlight(
            new Flight(
                $event->date(),
                $event->flightNumber(),
                $event->destination(),
                $event->gate()
            )
        );
    }

    private function handleFlightCancelledEvent(FlightCancelledEvent $event): void
    {
        $this->board->cancelFlight($event->flightNumber());
    }

    private function handleGateChangedEvent(GateChangedEvent $event): void
    {
        $this->board->changeGate($event->flightNumber(), $event->gate());
    }

    private function handleBoardingStartedEvent(BoardingStartedEvent $event): void
    {
        $this->board->startBoarding($event->flightNumber());
    }
}
