<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\DownloadCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Headline\Headline;

#[Flow\Proxy(false)]
final class DownloadCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly ?SlotInterface $media,
        public readonly ?Headline $headline,
        public readonly ?StringLike $primaryMetaHeadline,
        public readonly ?StringLike $secondaryMetaHeadline,
        public readonly ?SlotInterface $link
    ) {
    }
}
