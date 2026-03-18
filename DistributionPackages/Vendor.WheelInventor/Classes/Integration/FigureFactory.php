<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSourceFactory;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Figure\FigureSize;

final class FigureFactory
{
    public function __construct(
        private readonly ImageSourceFactory $imageSourceFactory
    ) {
    }

    public function tryForMixin(
        NeosContext $context,
        FigureSize $figureSize = FigureSize::SIZE_DEFAULT,
        bool $isLazyLoaded = false,
        string $propertyName = 'image',
        ?Node $node = null,
    ): ?Figure {
        $sourceNode = $node ?? $context->node;
        $image = $context->nodes->getObjectValue(
            $sourceNode,
            $propertyName,
            ImageSourceProxy::class
        );

        if ($image === null) {
            if (!$context->renderingMode->isEdit) {
                return null;
            }

            $imageSource = $this->imageSourceFactory->createForImageSourceInterface(
                new DummyImageSource(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    'Bild'
                )
            );
        } else {
            $imageSource = $this->imageSourceFactory->tryCreateForImageSourceProxy($image);
            if ($imageSource === null) {
                return null;
            }
        }

        return Figure::create(
            image: $imageSource,
            size: $figureSize,
            isLazyLoaded: $isLazyLoaded,
            class: null
        );
    }
}
