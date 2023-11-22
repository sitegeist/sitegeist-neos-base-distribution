<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

#[Flow\Proxy(false)]
final class Row extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly RowVariant $variant,
        public readonly RowJustification $justification,
        public readonly RowAlignment $alignment,
        public readonly SlotInterface $content
    ) {
    }
}
