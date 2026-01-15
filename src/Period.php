<?php

declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\RenderItemsTrait;

final class Period
{
    use CommentTrait;

    private const string EVENT = ': %s';

    /** @psalm-var list<string> */
    private array $events = [];

    public function __construct(private readonly string $label)
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

        $output[] = $this->renderComment($indentation);
        $output[] = $indentation . $this->label;

        foreach ($this->events as $event) {
            $output[] = $indentation . Mermaid::INDENTATION . sprintf(self::EVENT, $event);
        }

        return implode("\n", array_filter($output, fn($v) => !empty($v)));
    }
}