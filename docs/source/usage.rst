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

PHP
~~~

.. code-block:: php

    echo Mermaid::create(Timeline::class)
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

Generated Mermaid
~~~~~~~~~~~~~~~~~

.. code-block:: html

    <pre class="mermaid">
    timeline
      title History of Social Media Platform
      2002
        : LinkedIn
      2004
        : Facebook
        : Google
      2005
        : YouTube
      2006
        : Twitter
    </pre>

Mermaid Diagram
~~~~~~~~~~~~~~~

.. mermaid::

    timeline
      title History of Social Media Platform
      2002
        : LinkedIn
      2004
        : Facebook
        : Google
      2005
        : YouTube
      2006
        : Twitter

Timeline with Sections
++++++++++++++++++++++

PHP
~~~

.. code-block:: php

    echo Mermaid::create(Timeline::class)
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

Generated Mermaid
~~~~~~~~~~~~~~~~~

::

    <pre class="mermaid">
    timeline
      title Timeline of Industrial Revolution
      section 17th-20th century
        Industry 1.0 : Machinery, Water power, Steam <br>power
        Industry 2.0 : Electricity, Internal combustion engine, Mass production
        Industry 3.0 : Electronics, Computers, Automation
      section 21st century
        Industry 4.0 : Internet, Robotics, Internet of Things
        Industry 5.0 : Artificial intelligence, Big data, 3D printing
    </pre>

Mermaid Diagram
~~~~~~~~~~~~~~~

.. mermaid::

    timeline
      title Timeline of Industrial Revolution
      section 17th-20th century
        Industry 1.0 : Machinery, Water power, Steam <br>power
        Industry 2.0 : Electricity, Internal combustion engine, Mass production
        Industry 3.0 : Electronics, Computers, Automation
      section 21st century
        Industry 4.0 : Internet, Robotics, Internet of Things
        Industry 5.0 : Artificial intelligence, Big data, 3D printing
