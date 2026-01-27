Timeline Class
==============

.. php:class:: Timeline

    Represents a Timeline diagram

    .. php:method:: addPeriod(Period ...$period)

        Add period(s)

        :param Period ...$period: The period(s)
        :returns: A new instance of ``Timeline`` with the period(s) added
        :rtype: Timeline

    .. php:method:: addSection(Section ...$section)

        Add section(s)

        :param Section ...$section: The section(s)
        :returns: A new instance of ``Timeline`` with the section(s) added
        :rtype: Timeline

    .. php:method:: render(array $attributes = [])

        Renders the diagram

        :param array $attributes: HTML attributes for the <pre> tag as name=>value pairs

            .. note:: The *mermaid* class is added

        :returns: Mermaid diagram code in a <pre> tag
        :rtype: string

    .. php:method:: withComment(string $comment)

        Set a comment

        :param string $comment: The comment
        :returns: A new instance of ``Timeline`` with the comment
        :rtype: Timeline

    .. php:method:: withPeriod(Period ...$period)

        Set period(s)

        :param Period ...$period: The period(s)
        :returns: A new instance of ``Timeline`` with the period(s)
        :rtype: Timeline

    .. php:method:: withSection(Section ...$section)

        Set section(s)

        :param Section ...$section: The section(s)
        :returns: A new instance of ``Timeline`` with the section(s)
        :rtype: Timeline

    .. php:method:: withTitle(string $title)

        Set the timeline title

        :param string $title: The title
        :returns: A new instance of ``Timeline`` with the title
        :rtype: Timeline
