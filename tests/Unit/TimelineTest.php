<?php

use BeastBytes\Mermaid\Timeline\Event;
use BeastBytes\Mermaid\Timeline\Section;
use BeastBytes\Mermaid\Timeline\Timeline;

defined('COMMENT') or define('COMMENT', 'comment');

test('timeline with events', function () {
    $timeline = (new Timeline())
        ->withEvent(
            (new Event('Event 1 name'))
                ->withEvent('Text 1', 'Text 2')
            ,
            (new Event('Event 2 name'))
                ->withEvent('Text 3', 'Text 4')
            ,
        )
    ;

    expect($timeline->render())
        ->toBe("<pre class=\"mermaid\">\n"
               . "timeline\n"
               . "  Event 1 name\n"
               . "    : Text 1\n"
               . "    : Text 2\n"
               . "  Event 2 name\n"
               . "    : Text 3\n"
               . "    : Text 4\n"
               . '</pre>'
        )
        ->and($timeline
            ->addEvent(
                (new Event('Event 3 name'))
                    ->withEvent('Text 5', 'Text 6')
                ,
                (new Event('Event 4 name'))
                    ->withEvent('Text 7', 'Text 8')
                ,
            )
            ->render()
        )
        ->toBe("<pre class=\"mermaid\">\n"
               . "timeline\n"
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
               . "    : Text 8\n"
               . '</pre>'
        )
        ->and($timeline->withComment(COMMENT)->render(''))
        ->toBe("<pre class=\"mermaid\">\n"
               . '%% ' . COMMENT . "\n"
               . "timeline\n"
               . "  Event 1 name\n"
               . "    : Text 1\n"
               . "    : Text 2\n"
               . "  Event 2 name\n"
               . "    : Text 3\n"
               . "    : Text 4\n"
               . '</pre>'
        )
    ;
});

test('timeline with sections', function () {
    $timeline = (new Timeline())
        ->withSection(
            (new Section('Section 1'))
                ->withEvent(
                    (new Event('Event 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                    ,
                    (new Event('Event 2 name'))
                        ->withEvent('Text 3', 'Text 4')
                    ,
                ),
            (new Section('Section 2'))
                ->withEvent(
                    (new Event('Event 3 name'))
                        ->withEvent('Text 5', 'Text 6')
                    ,
                    (new Event('Event 4 name'))
                        ->withEvent('Text 7', 'Text 8')
                    ,
                ),
        )
    ;

    expect($timeline->render())
        ->toBe("<pre class=\"mermaid\">\n"
               . "timeline\n"
               . "  section Section 1\n"
               . "    Event 1 name\n"
               . "      : Text 1\n"
               . "      : Text 2\n"
               . "    Event 2 name\n"
               . "      : Text 3\n"
               . "      : Text 4\n"
               . "  section Section 2\n"
               . "    Event 3 name\n"
               . "      : Text 5\n"
               . "      : Text 6\n"
               . "    Event 4 name\n"
               . "      : Text 7\n"
               . "      : Text 8\n"
               . '</pre>'
        )
        ->and($timeline
            ->addSection(
                (new Section('Section 3'))
                    ->withEvent(
                        (new Event('Event 5 name'))
                            ->withEvent('Text 9', 'Text 10')
                        ,
                        (new Event('Event 6 name'))
                            ->withEvent('Text 11', 'Text 12')
                        ,
                  )
            )
            ->render()
        )
        ->toBe("<pre class=\"mermaid\">\n"
               . "timeline\n"
               . "  section Section 1\n"
               . "    Event 1 name\n"
               . "      : Text 1\n"
               . "      : Text 2\n"
               . "    Event 2 name\n"
               . "      : Text 3\n"
               . "      : Text 4\n"
               . "  section Section 2\n"
               . "    Event 3 name\n"
               . "      : Text 5\n"
               . "      : Text 6\n"
               . "    Event 4 name\n"
               . "      : Text 7\n"
               . "      : Text 8\n"
               . "  section Section 3\n"
               . "    Event 5 name\n"
               . "      : Text 9\n"
               . "      : Text 10\n"
               . "    Event 6 name\n"
               . "      : Text 11\n"
               . "      : Text 12\n"
               . '</pre>'
        )
    ;
});

test('add section to events throws exception', function () {
    $timeline = (new Timeline())
        ->withEvent(
            (new Event('Event 1 name'))
                ->withEvent('Text 1', 'Text 2')
        )
        ->addSection(
            (new Section('Section 1'))
                ->withEvent(
                    (new Event('Event 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                )
        )
    ;
})->throws(InvalidArgumentException::class, 'Can not mix Events and Sections');

test('add event to sections throws exception', function () {
    $timeline = (new Timeline())
        ->withSection(
            (new Section('Section 1'))
                ->withEvent(
                    (new Event('Event 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                )
        )
        ->addEvent(
            (new Event('Event 1 name'))
                ->withEvent('Text 1', 'Text 2')
        )
    ;
})->throws(InvalidArgumentException::class, 'Can not mix Events and Sections');
