<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;

/**
 * @implements \IteratorAggregate<Document|Shortcut>
 */
#[NodeTypeDeclaration]
#[Flow\Proxy(false)]
final readonly class Documents implements \IteratorAggregate
{
    /**
     * @var array<Document|Shortcut>
     */
    public array $items;

    public function __construct(Document|Shortcut ...$items)
    {
        $this->items = array_values($items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }
}
