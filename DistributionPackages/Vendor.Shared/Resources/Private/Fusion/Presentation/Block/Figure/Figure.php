<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;

#[Flow\Proxy(false)]
final readonly class Figure extends AbstractComponentPresentationObject
{
    public function __construct(
        public ImageSourceInterface $imageSource,
        public bool $isLazyLoaded,
        public FigureSize $size,
        public FigureObjectFit $objectFit,
        public FigureObjectPosition $objectPosition,
        public FigureAspectRatio $aspectRatio
    ) {
    }
}
