<?php

/*
 * This file is part of the Vendor.Shared package.
 */

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
    private array $icons;

    public function __construct(Icon ...$icons)
    {
        /** @phpstan-var array<int,Icon> $icons */
        $this->icons = $icons;
    }

    /**
     * @return \ArrayIterator<int,Icon>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->icons);
    }

    public function fromIconName(string $iconName): ?Icon
    {
        foreach ($this->icons as $icon) {
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
        return count($this->icons);
    }
}
