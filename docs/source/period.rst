Period Class
============

.. php:class:: Period

    Represents a Period for :php:class:`Section` or :php:class:`Timeline`

    .. php:method:: __construct(string $label)

        Creates a new Period

        :param string $label: The period label
        :returns: A Period instance
        :rtype: Period

    .. php:method:: addEvent(string ...$event)

        Add event(s)

        :param Period ...$event: The event(s)
        :returns: A new instance of ``Period`` with the event(s) added
        :rtype: Period

    .. php:method:: withComment(string $comment)

        Set a comment

        :param string $comment: The comment
        :returns: A new instance of ``Period`` with the comment
        :rtype: Period

    .. php:method:: withEvent(string ...$event)

        Set event(s)

        :param Period ...$event: The event(s)
        :returns: A new instance of ``Period`` with the event(s)
        :rtype: Period
