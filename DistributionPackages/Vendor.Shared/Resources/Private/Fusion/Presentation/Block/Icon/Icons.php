<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Icon;

use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Annotations as Flow;

/**
 * @implements \IteratorAggregate<int,Icon>
 */
#[Flow\Proxy(false)]
final class Icons implements \IteratorAggregate, \Countable, ProtectedContextAwareInterface
{
    /**
     * @var array<int,Icon>
     */
    private array $items;

    public function __construct(Icon ...$items)
    {
        $this->items = array_values($items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

    public function fromIconName(string $iconName): ?Icon
    {
        foreach ($this->items as $icon) {
            if ($icon->name->equals($iconName)) {
                return $icon;
            }
        }
        return null;
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }

    public function count(): int
    {
        return count($this->items);
    }
}
