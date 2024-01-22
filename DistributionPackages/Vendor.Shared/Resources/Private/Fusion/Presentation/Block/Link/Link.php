<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;

#[Flow\Proxy(false)]
final class Link extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly LinkVariant $variant,
        public readonly ArchaeopteryxLink $link,
        public readonly SlotInterface $content,
        public readonly bool $inBackend
    ) {
    }
}
