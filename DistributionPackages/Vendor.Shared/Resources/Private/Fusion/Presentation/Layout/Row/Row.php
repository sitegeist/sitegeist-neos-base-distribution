<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

#[Flow\Proxy(false)]
final readonly class Row extends AbstractComponentPresentationObject
{
    public function __construct(
        public RowVariant $variant,
        public RowJustification $justification,
        public RowAlignment $alignment,
        public SlotInterface $content
    ) {
    }
}
