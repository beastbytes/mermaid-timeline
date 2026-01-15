<?php

declare(strict_types=1);

use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\Timeline\Period;
use BeastBytes\Mermaid\Timeline\Section;
use BeastBytes\Mermaid\Timeline\Timeline;

defined('COMMENT') or define('COMMENT', 'comment');

test('timeline with periods', function () {
    $timeline = Mermaid::create(Timeline::class)
        ->withPeriod(
            (new Period('Period 1 name'))
                ->withEvent('Text 1', 'Text 2')
            ,
            (new Period('Period 2 name'))
                ->withEvent('Text 3', 'Text 4')
            ,
        )
    ;

    expect($timeline->render())
        ->toBe(<<<EXPECTED
<pre class="mermaid">
timeline
  Period 1 name
    : Text 1
    : Text 2
  Period 2 name
    : Text 3
    : Text 4
</pre>
EXPECTED
        )
        ->and($timeline
            ->addPeriod(
                (new Period('Period 3 name'))
                    ->withEvent('Text 5', 'Text 6')
                ,
                (new Period('Period 4 name'))
                    ->withEvent('Text 7', 'Text 8')
                ,
            )
            ->render()
        )
        ->toBe(<<<EXPECTED
<pre class="mermaid">
timeline
  Period 1 name
    : Text 1
    : Text 2
  Period 2 name
    : Text 3
    : Text 4
  Period 3 name
    : Text 5
    : Text 6
  Period 4 name
    : Text 7
    : Text 8
</pre>
EXPECTED
        )
        ->and($timeline->withComment(COMMENT)->render())
        ->toBe(<<<EXPECTED
<pre class="mermaid">
%% comment
timeline
  Period 1 name
    : Text 1
    : Text 2
  Period 2 name
    : Text 3
    : Text 4
</pre>
EXPECTED
        )
    ;
});

test('timeline with sections', function () {
    $timeline = Mermaid::create(Timeline::class)
        ->withSection(
            (new Section('Section 1'))
                ->withPeriod(
                    (new Period('Period 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                    ,
                    (new Period('Period 2 name'))
                        ->withEvent('Text 3', 'Text 4')
                    ,
                ),
            (new Section('Section 2'))
                ->withPeriod(
                    (new Period('Period 3 name'))
                        ->withEvent('Text 5', 'Text 6')
                    ,
                    (new Period('Period 4 name'))
                        ->withEvent('Text 7', 'Text 8')
                    ,
                ),
        )
    ;

    expect($timeline->render())
        ->toBe(<<<EXPECTED
<pre class="mermaid">
timeline
  section Section 1
    Period 1 name
      : Text 1
      : Text 2
    Period 2 name
      : Text 3
      : Text 4
  section Section 2
    Period 3 name
      : Text 5
      : Text 6
    Period 4 name
      : Text 7
      : Text 8
</pre>
EXPECTED
        )
        ->and($timeline
            ->addSection(
                (new Section('Section 3'))
                    ->withPeriod(
                        (new Period('Period 5 name'))
                            ->withEvent('Text 9', 'Text 10')
                        ,
                        (new Period('Period 6 name'))
                            ->withEvent('Text 11', 'Text 12')
                        ,
                  )
            )
            ->render()
        )
        ->toBe(<<<EXPECTED
<pre class="mermaid">
timeline
  section Section 1
    Period 1 name
      : Text 1
      : Text 2
    Period 2 name
      : Text 3
      : Text 4
  section Section 2
    Period 3 name
      : Text 5
      : Text 6
    Period 4 name
      : Text 7
      : Text 8
  section Section 3
    Period 5 name
      : Text 9
      : Text 10
    Period 6 name
      : Text 11
      : Text 12
</pre>
EXPECTED
        )
    ;
});

test('add section to periods throws exception', function () {
    Mermaid::create(Timeline::class)
        ->withPeriod(
            (new Period('Period 1 name'))
                ->withEvent('Text 1', 'Text 2')
        )
        ->addSection(
            (new Section('Section 1'))
                ->withEvent(
                    (new Period('Period 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                )
        )
    ;
})->throws(InvalidArgumentException::class, 'Periods and Sections cannot be mixed');

test('add period to sections throws exception', function () {
    Mermaid::create(Timeline::class)
        ->withSection(
            (new Section('Section 1'))
                ->withEvent(
                    (new Period('Period 1 name'))
                        ->withEvent('Text 1', 'Text 2')
                )
        )
        ->addPeriod(
            (new Period('Period 1 name'))
                ->withEvent('Text 1', 'Text 2')
        )
    ;
})->throws(InvalidArgumentException::class, 'Periods and Sections cannot be mixed');