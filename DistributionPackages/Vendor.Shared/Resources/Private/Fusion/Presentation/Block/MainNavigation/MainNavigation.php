<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\MainNavigation;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use Vendor\Shared\Presentation\Block\NavigationItem\NavigationItems;

#[Flow\Proxy(false)]
final class MainNavigation extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly ?NavigationItems $items,
    ) {
    }
}
