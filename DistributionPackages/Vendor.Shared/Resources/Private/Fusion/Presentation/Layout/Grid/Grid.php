<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Grid;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

#[Flow\Proxy(false)]
final readonly class Grid extends AbstractComponentPresentationObject
{
    public function __construct(
        public GridVariant $variant,
        public SlotInterface $content
    ) {
    }
}
