<?php declare(strict_types=1);

namespace thephpcc\cqrs\departureboard;

use thephpcc\cqrs\EventStoreStub;

require __DIR__ . '/src/autoload.php';

while (true) {
    $eventStore = EventStoreStub::load();

    $board     = new DepartureInformationBoard;
    $projector = new Projector($board);

    foreach ($eventStore->all() as $event) {
        $projector->handle($event);
    }

    system('clear');
    print $board->asString() . PHP_EOL;

    sleep(3);
}
