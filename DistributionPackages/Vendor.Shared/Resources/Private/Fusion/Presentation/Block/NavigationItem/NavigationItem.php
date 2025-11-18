<?php

/*
 * This file is part of the EulerHermes.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\NavigationItem;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use Psr\Http\Message\UriInterface;

#[Flow\Proxy(false)]
final class NavigationItem extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly UriInterface $uri,
        public readonly StringLike $label,
        public readonly bool $isActive,
        public readonly ?NavigationItems $items,
    ) {
    }
}
