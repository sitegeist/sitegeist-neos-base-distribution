<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\AccordionItem;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use Vendor\Shared\Presentation\Block\Icon\Icon;

#[Flow\Proxy(false)]
final class AccordionItem extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly StringLike $header,
        public readonly SlotInterface $content,
        public readonly Icon $dashIcon,
        public readonly Icon $plusIcon,
        public readonly bool $isOpen,
        public readonly bool $inBackend
    ) {
    }
}
