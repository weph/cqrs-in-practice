<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

use thephpcc\cqrs\EventStoreStub;
use thephpcc\cqrs\FlightCancelledEvent;
use thephpcc\cqrs\FlightScheduledEvent;
use thephpcc\cqrs\GateChangedEvent;

require __DIR__ . '/src/autoload.php';

$eventStore = new EventStoreStub;

$eventStore->store(
    new FlightScheduledEvent(
        new \DateTimeImmutable('2021-01-18 11:55'),
        'LH 414',
        'Washington',
        'A01'
    )
);

$eventStore->store(
    new FlightScheduledEvent(
        new \DateTimeImmutable('2021-01-18 13:05'),
        'AF 040',
        'Paris',
        'B01'
    )
);

$eventStore->store(
    new FlightScheduledEvent(
        new \DateTimeImmutable('2021-01-18 14:15'),
        'OS 0815',
        'Vienna',
        'C02'
    )
);

//$eventStore->store(
//    new FlightCancelledEvent('AF 040')
//);

//$eventStore->store(new GateChangedEvent('LH 414', 'C03'));
//
//$eventStore->store(new GateChangedEvent('OS 0815', 'F09'));

$eventStore->commit();
