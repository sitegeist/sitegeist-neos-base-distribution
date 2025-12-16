<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Icon;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;

#[Flow\Proxy(false)]
final readonly class Icon extends AbstractComponentPresentationObject
{
    public function __construct(
        public IconName $name,
        public IconSize $size,
        public IconColor $color,
        public IconCollection $collection
    ) {
    }

    public static function specifiedWith(
        IconName $iconName,
        IconSize $iconSize,
        IconColor $iconColor,
        IconCollection $iconCollection = IconCollection::COLLECTION_SHARED
    ): self {
        return new self(
            $iconName,
            $iconSize,
            $iconColor,
            $iconCollection
        );
    }
}
