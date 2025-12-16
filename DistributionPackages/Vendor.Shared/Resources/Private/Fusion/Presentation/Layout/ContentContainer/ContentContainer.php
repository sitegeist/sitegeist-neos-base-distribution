<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\ContentContainer;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

#[Flow\Proxy(false)]
final readonly class ContentContainer extends AbstractComponentPresentationObject
{
    public function __construct(
        public ContentContainerVariant $variant,
        public SlotInterface $content
    ) {
    }
}
