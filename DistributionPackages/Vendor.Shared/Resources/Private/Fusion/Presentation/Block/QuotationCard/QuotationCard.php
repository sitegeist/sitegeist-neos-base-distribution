<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\QuotationCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Psr\Http\Message\UriInterface;

#[Flow\Proxy(false)]
final readonly class QuotationCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public UriInterface $quotationImageUri,
        public ?SlotInterface $media,
        public ?SlotInterface $header,
        public ?SlotInterface $subheader,
        public ?SlotInterface $supportingText,
        public ?SlotInterface $additionalContent,
    ) {
    }
}
