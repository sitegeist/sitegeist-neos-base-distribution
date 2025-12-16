<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Headline;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;

#[Flow\Proxy(false)]
final readonly class Headline extends AbstractComponentPresentationObject
{
    public function __construct(
        public HeadlineVariant $variant,
        public HeadlineType $type,
        public StringLike $content
    ) {
    }
}
