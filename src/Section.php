<?php

declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\RenderItemsTrait;

final class Section
{
    use CommentTrait;
    use RenderItemsTrait;

    private const string SECTION = 'section %s';

    /** @psalm-var list<Period> */
    private array $periods = [];

    public function __construct(private readonly string $label)
    {
    }

    public function addPeriod(Period ...$period): self
    {
        $new = clone $this;
        $new->periods = array_merge($new->periods, $period);
        return $new;
    }

    public function withPeriod(Period ...$period): self
    {
        $new = clone $this;
        $new->periods = $period;
        return $new;
    }

    public function render(string $indentation): string
    {
        $output = [];

        $output[] = $this->renderComment($indentation);
        $output[] = $indentation . sprintf(self::SECTION, $this->label);
        $output[] = $this->renderItems($this->periods, $indentation);

        return implode("\n", array_filter($output, fn($v) => !empty($v)));
    }
}