<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Flow\Annotations as Flow;

/**
 * @implements \IteratorAggregate<int,Figure>
 */
#[Flow\Proxy(false)]
final readonly class Figures implements \IteratorAggregate
{
    /**
     * @var array<int,Figure>
     */
    private array $items;

    public function __construct(Figure ...$items)
    {
        $this->items = array_values($items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }
}
