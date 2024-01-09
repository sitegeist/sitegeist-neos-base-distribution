<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\QuotationCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Psr\Http\Message\UriInterface;

#[Flow\Proxy(false)]
final class QuotationCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly UriInterface $quotationImageUri,
        public readonly ?SlotInterface $media,
        public readonly ?SlotInterface $header,
        public readonly ?SlotInterface $subheader,
        public readonly ?SlotInterface $supportingText,
        public readonly ?SlotInterface $additionalContent,
    ) {
    }
}
