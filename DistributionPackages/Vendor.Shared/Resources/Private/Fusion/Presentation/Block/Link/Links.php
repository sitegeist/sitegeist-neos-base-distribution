<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Flow\Annotations as Flow;

/**
 * @implements \IteratorAggregate<int,Link>
 */
#[Flow\Proxy(false)]
final class Links implements \IteratorAggregate, \Countable
{
    /**
     * @var array<int,Link>
     */
    private array $links;

    public function __construct(Link ...$links)
    {
        /** @phpstan-var array<int,Link> $links */
        $this->links = $links;
    }

    /**
     * @return \ArrayIterator<int,Link>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->links);
    }

    public function count(): int
    {
        return count($this->links);
    }
}
