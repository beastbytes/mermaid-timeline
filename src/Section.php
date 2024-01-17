<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\RenderItemsTrait;

final class Section
{
    use CommentTrait;
    use RenderItemsTrait;

    private const TYPE = 'section';

    /** @psalm-var list<Event> */
    private array $events = [];

    public function __construct(private readonly string $name)
    {
    }

    public function addEvent(Event ...$event): self
    {
        $new = clone $this;
        $new->events = array_merge($new->events, $event);
        return $new;
    }

    public function withEvent(Event ...$event): self
    {
        $new = clone $this;
        $new->events = $event;
        return $new;
    }

    public function render(string $indentation): string
    {
        $output = [];

        $this->renderComment($indentation, $output);
        $output[] = $indentation . self::TYPE . ' ' . $this->name;
        $this->renderItems($this->events, $indentation, $output);

        return implode("\n", $output);
    }
}
