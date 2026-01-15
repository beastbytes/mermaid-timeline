<?php

declare(strict_types=1);

use BeastBytes\Mermaid\Timeline\Period;

defined('COMMENT') or define('COMMENT', 'comment');

test('period', function () {
    $period = (new Period('Period Label'))
        ->withEvent('Text 1', 'Text 2')
    ;

    expect($period->render(''))
        ->toBe(<<<EXPECTED
Period Label
  : Text 1
  : Text 2
EXPECTED
        )
        ->and($period->addEvent('Text 3', 'Text 4')->render(''))
        ->toBe(<<<EXPECTED
Period Label
  : Text 1
  : Text 2
  : Text 3
  : Text 4
EXPECTED
        )
        ->and($period->withComment(COMMENT)->render(''))
        ->toBe(<<<EXPECTED
%% comment
Period Label
  : Text 1
  : Text 2
EXPECTED
        )
    ;
});