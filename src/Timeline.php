<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\Timeline;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\MermaidInterface;
use BeastBytes\Mermaid\RenderItemsTrait;
use BeastBytes\Mermaid\TitleTrait;
use InvalidArgumentException;
use Stringable;

final class Timeline implements MermaidInterface, Stringable
{
    use CommentTrait;
    use RenderItemsTrait;
    use TitleTrait;

    private const IS_EVENT = false;
    private const IS_SECTION = true;
    private const TYPE = 'timeline';

    /** @psalm-var list<Event|Section> */
    private array $items = [];
    private ?bool $itemType = null;

    public function __toString(): string
    {
        return $this->render();
    }

    public function addEvent(Event ...$event): self
    {
        if ($this->itemType === self::IS_SECTION) {
            throw new InvalidArgumentException('Can not mix Events and Sections');
        }

        $new = clone $this;
        $new->items = array_merge($new->items, $event);
        return $new;
    }

    public function addSection(Section ...$section): self
    {
        if ($this->itemType === self::IS_EVENT) {
            throw new InvalidArgumentException('Can not mix Events and Sections');
        }

        $new = clone $this;
        $new->items = array_merge($new->items, $section);
        return $new;
    }

    public function withEvent(Event ...$event): self
    {
        $new = clone $this;
        $new->items = $event;
        $new->itemType = self::IS_EVENT;
        return $new;
    }

    public function withSection(Section ...$section): self
    {
        $new = clone $this;
        $new->items = $section;
        $new->itemType = self::IS_SECTION;
        return $new;
    }

    public function render(array $attributes = []): string
    {
        $output = [];

        $this->renderComment('', $output);
        $output[] = self::TYPE;

        if ($this->title !== '') {
            $output[] = Mermaid::INDENTATION . 'title ' . $this->title;
        }

        $this->renderItems($this->items, '', $output);

        return Mermaid::render($output, $attributes);
    }
}
