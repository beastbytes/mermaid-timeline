Usage
=====

Timeline allows drawing diagrams that illustrate a chronology of events, dates, or periods of time.

Periods
-------
A Period has a label and one or more events; an event is a string describing the event.

The periods are then added to the timeline or a section.

Sections
--------
Periods can be grouped in sections; a Section has a label and one or more periods.

The sections are then added to the timeline.

.. note::
A Timeline can only contain Periods or Sections, not both.

Examples
--------

Timeline with Periods
+++++++++++++++++++++

.. code-block:: php

    Mermaid::create(Timeline::class)
        ->withTitle('History of Social Media Platform')
        ->withPeriod(
            (new Period('2002'))
                ->withEvent('LinkedIn')
            ,
            (new Period('2004'))
                ->withEvent('Facebook', 'Google')
            ,
            (new Period('2005'))
                ->withEvent('YouTube')
            ,
            (new Period('2006'))
                ->withEvent('Twitter')
        )
        ->render()
    ;

Timeline with Sections
++++++++++++++++++++++

.. code-block:: php

    Mermaid::create(Timeline::class)
        ->withTitle('Timeline of Industrial Revolution')
        ->withSection(
            (new Section('17th-20th century'))
                ->withPeriod(
                    (new Period('Industry 1.0'))
                        ->withEvent('Machinery', 'Water power', 'Steam power')
                    ,
                    (new Period('Industry 2.0'))
                        ->withEvent('Electricity', 'Internal combustion engine', 'Mass production')
                    ,
                    (new Period('Industry 3.0'))
                        ->withEvent('Electronics', 'Computers', 'Automation')
            ,
            (new Section('21st century'))
                ->withPeriod(
                    (new Period('Industry 4.0'))
                        ->withEvent('Internet', 'Robotics', 'Internet of Things')
                    ,
                    (new Period('Industry 5.0'))
                        ->withEvent('Artificial intelligence', 'Big data', '3D printing')
        )
        ->render()
    ;
