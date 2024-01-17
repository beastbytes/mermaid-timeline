<?php

use BeastBytes\Mermaid\Timeline\Event;
use BeastBytes\Mermaid\Timeline\Section;

defined('COMMENT') or define('COMMENT', 'comment');

test('section', function () {
    $section = (new Section('Section name'))
        ->withEvent(
            (new Event('Event 1 name'))
                ->withEvent('Text 1', 'Text 2')
            ,
            (new Event('Event 2 name'))
                ->withEvent('Text 3', 'Text 4')
            ,
        )
    ;

    expect($section->render(''))
        ->toBe("section Section name\n"
            . "  Event 1 name\n"
            . "    : Text 1\n"
            . "    : Text 2\n"
            . "  Event 2 name\n"
            . "    : Text 3\n"
            . '    : Text 4'
        )
        ->and($section
            ->addEvent(
                (new Event('Event 3 name'))
                    ->withEvent('Text 5', 'Text 6')
                ,
                (new Event('Event 4 name'))
                    ->withEvent('Text 7', 'Text 8')
                ,
            )
            ->render('')
        )
        ->toBe("section Section name\n"
             . "  Event 1 name\n"
             . "    : Text 1\n"
             . "    : Text 2\n"
             . "  Event 2 name\n"
             . "    : Text 3\n"
             . "    : Text 4\n"
             . "  Event 3 name\n"
             . "    : Text 5\n"
             . "    : Text 6\n"
             . "  Event 4 name\n"
             . "    : Text 7\n"
             . '    : Text 8'
        )
        ->and($section->withComment(COMMENT)->render(''))
        ->toBe('%% ' . COMMENT . "\n"
            . "section Section name\n"
            . "  Event 1 name\n"
            . "    : Text 1\n"
            . "    : Text 2\n"
            . "  Event 2 name\n"
            . "    : Text 3\n"
            . '    : Text 4'
        )
    ;
});
