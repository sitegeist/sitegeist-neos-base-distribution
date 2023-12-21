<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\VerticalCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Text\Text;

#[Flow\Proxy(false)]
final class VerticalCard extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly VerticalCardVariant $variant,
        public readonly ?Figure $figure,
        public readonly ?Headline $headline,
        public readonly ?Text $text,
        public readonly ?SlotInterface $button
    ) {
    }
}
