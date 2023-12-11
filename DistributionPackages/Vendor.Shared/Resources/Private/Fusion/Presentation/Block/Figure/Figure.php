<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;

#[Flow\Proxy(false)]
final class Figure extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly ImageSourceInterface $imageSource,
        public readonly bool $isLazyLoaded,
        public readonly FigureSize $size,
        public readonly FigureObjectFit $objectFit,
        public readonly FigureObjectPosition $objectPosition,
        public readonly FigureAspectRatio $aspectRatio
    ) {
    }
}
