<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\AccordionItem;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use Vendor\Shared\Presentation\Block\Icon\Icon;

#[Flow\Proxy(false)]
final readonly class AccordionItem extends AbstractComponentPresentationObject
{
    public function __construct(
        public StringLike $header,
        public SlotInterface $content,
        public Icon $dashIcon,
        public Icon $plusIcon,
        public bool $isOpen,
        public bool $inBackend
    ) {
    }
}
