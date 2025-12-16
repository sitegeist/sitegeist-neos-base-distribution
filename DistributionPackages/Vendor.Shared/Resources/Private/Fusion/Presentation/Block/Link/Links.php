<?php

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
        $this->links = array_values($links);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->links;
    }

    public function count(): int
    {
        return count($this->links);
    }
}
