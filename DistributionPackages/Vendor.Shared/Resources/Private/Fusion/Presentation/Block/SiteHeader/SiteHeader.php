<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\SiteHeader;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\MainNavigation\MainNavigation;

#[Flow\Proxy(false)]
final readonly class SiteHeader extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly Link $homeLink,
        public readonly MainNavigation $mainNavigation
    ) {
    }
}
