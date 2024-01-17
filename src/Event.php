<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\RenderItemsTrait;

final class Event
{
    use CommentTrait;

    /** @psalm-var list<string> */
    private array $events = [];

    public function __construct(private readonly string $period)
    {
    }

    public function addEvent(string ...$event): self
    {
        $new = clone $this;
        $new->events = array_merge($new->events, $event);
        return $new;
    }

    public function withEvent(string ...$event): self
    {
        $new = clone $this;
        $new->events = $event;
        return $new;
    }

    public function render(string $indentation): string
    {
        $output = [];

        $this->renderComment($indentation, $output);
        $output[] = $indentation . $this->period;
        $output[] = $indentation . Mermaid::INDENTATION . ': '
            . implode("\n" . $indentation . Mermaid::INDENTATION . ': ', $this->events);

        return implode("\n", $output);
    }
}
