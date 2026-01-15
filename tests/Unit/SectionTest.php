<?php

declare(strict_types=1);

use BeastBytes\Mermaid\Timeline\Period;
use BeastBytes\Mermaid\Timeline\Section;

defined('COMMENT') or define('COMMENT', 'comment');

test('section', function () {
    $section = (new Section('Section name'))
        ->withEvent(
            (new Period('Period 1 Label'))
                ->withEvent('Text 1', 'Text 2')
            ,
            (new Period('Period 2 Label'))
                ->withEvent('Text 3', 'Text 4')
            ,
        )
    ;

    expect($section->render(''))
        ->toBe(<<<EXPECTED
section Section name
  Period 1 Label
    : Text 1
    : Text 2
  Period 2 Label
    : Text 3
    : Text 4
EXPECTED
        )
        ->and($section
            ->addEvent(
                (new Period('Period 3 Label'))
                    ->withEvent('Text 5', 'Text 6')
                ,
                (new Period('Period 4 Label'))
                    ->withEvent('Text 7', 'Text 8')
                ,
            )
            ->render('')
        )
        ->toBe(<<<EXPECTED
section Section name
  Period 1 Label
    : Text 1
    : Text 2
  Period 2 Label
    : Text 3
    : Text 4
  Period 3 Label
    : Text 5
    : Text 6
  Period 4 Label
    : Text 7
    : Text 8
EXPECTED
        )
        ->and($section->withComment(COMMENT)->render(''))
        ->toBe(<<<EXPECTED
%% comment
section Section name
  Period 1 Label
    : Text 1
    : Text 2
  Period 2 Label
    : Text 3
    : Text 4
EXPECTED
        )
    ;
});