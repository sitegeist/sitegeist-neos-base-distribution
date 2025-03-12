<?php

/*
 * This file is part of the Nordmann.Shared package.
 */

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
    private array $navigationItems;

    public function __construct(NavigationItem ...$navigationItems)
    {
        /** @phpstan-var array<int,NavigationItem> $navigationItems */
        $this->navigationItems = $navigationItems;
    }

    /**
     * @return \ArrayIterator<int,NavigationItem>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->navigationItems);
    }

    public function count(): int
    {
        return count($this->navigationItems);
    }

    public function getHasItems(): bool
    {
        return count($this->navigationItems) > 0;
    }
}
