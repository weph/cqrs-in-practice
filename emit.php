<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

use DateTimeImmutable;
use thephpcc\cqrs\BoardingStartedEvent;
use thephpcc\cqrs\EventStoreStub;
use thephpcc\cqrs\FlightCancelledEvent;
use thephpcc\cqrs\FlightScheduledEvent;
use thephpcc\cqrs\GateChangedEvent;

require __DIR__ . '/src/autoload.php';

$eventStore = EventStoreStub::load();

switch ($argv[1]) {
    case 'schedule':
        $eventStore->store(
            new FlightScheduledEvent(
                new DateTimeImmutable($argv[2]),
                $argv[3],
                $argv[4],
                $argv[5]
            )
        );
        break;

    case 'cancel':
        $eventStore->store(new FlightCancelledEvent($argv[2]));
        break;

    case 'change':
        $eventStore->store(new GateChangedEvent($argv[2], $argv[3]));
        break;

    case 'boarding':
        $eventStore->store(new BoardingStartedEvent($argv[2]));
        break;
}

$eventStore->commit();
