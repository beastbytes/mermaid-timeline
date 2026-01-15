Section Class
=============

.. php:class:: Section

    Represents a Section for :php:class:`Timeline`

    .. php:method:: __construct(string $label)

        Creates a new Section

        :param string $label: The section label
        :returns: A Section instance
        :rtype: Section

    .. php:method:: addPeriod(Period ...$period)

        Add period(s)

        :param Period ...$period: The period(s)
        :returns: A new instance of ``Section`` with the period(s) added
        :rtype: Section

    .. php:method:: withComment(string $comment)

        Set a comment

        :param string $comment: The comment
        :returns: A new instance of ``Section`` with the comment
        :rtype: Section

    .. php:method:: withPeriod(Period ...$period)

        Set period(s)

        :param Period ...$period: The period(s)
        :returns: A new instance of ``Section`` with the period(s)
        :rtype: Section
