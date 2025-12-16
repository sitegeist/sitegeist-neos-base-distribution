<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\NavigationItem;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use Psr\Http\Message\UriInterface;

#[Flow\Proxy(false)]
final readonly class NavigationItem extends AbstractComponentPresentationObject
{
    public function __construct(
        public UriInterface $uri,
        public StringLike $label,
        public bool $isActive,
        public ?NavigationItems $items,
    ) {
    }
}
