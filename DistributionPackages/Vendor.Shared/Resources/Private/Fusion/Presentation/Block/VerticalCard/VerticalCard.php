<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\VerticalCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Text\Text;

#[Flow\Proxy(false)]
final readonly class VerticalCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public VerticalCardVariant $variant,
        public ?Figure $figure,
        public ?Headline $headline,
        public ?Text $text,
        public ?SlotInterface $button
    ) {
    }
}
