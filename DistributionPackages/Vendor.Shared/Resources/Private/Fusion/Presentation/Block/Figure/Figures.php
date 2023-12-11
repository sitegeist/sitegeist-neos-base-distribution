<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Flow\Annotations as Flow;

/**
 * @implements \IteratorAggregate<Figure>
 */
#[Flow\Proxy(false)]
final class Figures implements \IteratorAggregate
{
    /**
     * @var array<Figure>
     */
    private readonly array $figures;

    public function __construct(
        Figure ...$figures
    ) {
        $this->figures = $figures;
    }

    /**
     * @return \Traversable<Figure>
     */
    public function getIterator(): \Traversable
    {
        yield from $this->figures;
    }
}
