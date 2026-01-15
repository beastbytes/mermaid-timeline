<?php


declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Diagram;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\RenderItemsTrait;
use BeastBytes\Mermaid\TitleTrait;
use InvalidArgumentException;

final class Timeline extends Diagram
{
    use CommentTrait;
    use RenderItemsTrait;
    use TitleTrait;

    private const string EXCEPTION = 'Periods and Sections cannot be mixed';
    private const string PERIOD = 'period';
    private const string SECTION = 'section';
    private const string TYPE = 'timeline';

    /** @psalm-var list<Period>|list<Section> */
    private array $items = [];
    private ?string $itemType = null;

    public function addPeriod(Period ...$period): self
    {
        if ($this->itemType === self::SECTION) {
            throw new InvalidArgumentException(self::EXCEPTION);
        }

        $new = clone $this;
        $new->items = array_merge($new->items, $period);
        return $new;
    }

    public function addSection(Section ...$section): self
    {
        if ($this->itemType === self::PERIOD) {
            throw new InvalidArgumentException(self::EXCEPTION);
        }

        $new = clone $this;
        $new->items = array_merge($new->items, $section);
        return $new;
    }

    public function withPeriod(Period ...$period): self
    {
        $new = clone $this;
        $new->items = $period;
        $new->itemType = self::PERIOD;
        return $new;
    }

    public function withSection(Section ...$section): self
    {
        $new = clone $this;
        $new->items = $section;
        $new->itemType = self::SECTION;
        return $new;
    }

    public function renderDiagram(): string
    {
        $output = [];

        $output[] = $this->renderComment('');
        $output[] = self::TYPE;
        $output[] = $this->renderTitle(Mermaid::INDENTATION);
        $output[] = $this->renderItems($this->items, '');

        return implode("\n", array_filter($output, fn($v) => !empty($v)));
    }
}