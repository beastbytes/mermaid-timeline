<?php

use BeastBytes\Mermaid\Timeline\Event;

defined('COMMENT') or define('COMMENT', 'comment');

test('event', function () {
    $event = (new Event('Event name'))
        ->withEvent('Text 1', 'Text 2')
    ;

    expect($event->render(''))
        ->toBe("Event name\n"
            . "  : Text 1\n"
            . '  : Text 2'
        )
        ->and($event->addEvent('Text 3', 'Text 4')->render(''))
        ->toBe("Event name\n"
            . "  : Text 1\n"
            . "  : Text 2\n"
            . "  : Text 3\n"
            . '  : Text 4'
        )
        ->and($event->withComment(COMMENT)->render(''))
        ->toBe('%% ' . COMMENT . "\n"
            . "Event name\n"
            . "  : Text 1\n"
            . '  : Text 2'
        )
    ;
});
