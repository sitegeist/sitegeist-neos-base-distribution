<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\DownloadCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Headline\Headline;

#[Flow\Proxy(false)]
final readonly class DownloadCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public ?SlotInterface $media,
        public ?Headline $headline,
        public ?StringLike $primaryMetaHeadline,
        public ?StringLike $secondaryMetaHeadline,
        public ?SlotInterface $link
    ) {
    }
}
