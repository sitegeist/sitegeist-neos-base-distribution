<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\NavigationItem;

use Neos\Flow\Annotations as Flow;

/**
 * @implements \IteratorAggregate<int,NavigationItem>
 */
#[Flow\Proxy(false)]
final class NavigationItems implements \IteratorAggregate, \Countable
{
    /**
     * @var array<int,NavigationItem>
     */
    private array $items;

    public function __construct(NavigationItem ...$items)
    {
        $this->items = array_values($items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getHasItems(): bool
    {
        return count($this->items) > 0;
    }
}
