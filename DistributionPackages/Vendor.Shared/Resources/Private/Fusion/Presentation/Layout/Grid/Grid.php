<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Grid;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

#[Flow\Proxy(false)]
final class Grid extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly GridVariant $variant,
        public readonly SlotInterface $content
    ) {
    }
}
