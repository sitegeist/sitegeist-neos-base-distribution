<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSourceFactory;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Figure\FigureSize;
use Vendor\Shared\NodeTypes\Mixin\ImageProvider;
use Vendor\Shared\NodeTypes\Mixin\OptionalImageProvider;
use Vendor\Shared\NodeTypes\Mixin\PreviewProvider;

final class FigureFactory
{
    public function __construct(
        private readonly ImageSourceFactory $imageSourceFactory
    ) {
    }

    public function tryForImageProvider(
        ImageProvider $imageProvider,
        FigureSize $figureSize = FigureSize::SIZE_DEFAULT,
        bool $isLazyLoaded = false,
    ): ?Figure {
        $imageSource = $this->imageSourceFactory->tryCreateForImageSourceProxy($imageProvider->image);
        if ($imageSource === null) {
            return null;
        }

        return Figure::create(
            image: $imageSource,
            size: $figureSize,
            isLazyLoaded: $isLazyLoaded,
        );
    }

    public function tryForOptionalImageProvider(
        OptionalImageProvider $optionalImageProvider,
        FigureSize $figureSize = FigureSize::SIZE_DEFAULT,
        bool $isLazyLoaded = false,
        bool $inBackend = false,
    ): ?Figure {
        $imageSource = $optionalImageProvider->image
            ? $this->imageSourceFactory->tryCreateForImageSourceProxy($optionalImageProvider->image)
            : null;

        if ($imageSource === null && $inBackend) {
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
        }

        return $imageSource
            ? Figure::create(
                image: $imageSource,
                size: $figureSize,
                isLazyLoaded: $isLazyLoaded,
            )
            : null;
    }

    public function tryForPreviewImageProvider(
        PreviewProvider $previewProvider,
        # shouldn't this be a fixed thingy for preview images?
        FigureSize $figureSize = FigureSize::SIZE_DEFAULT,
    ): ?Figure {
        if ($previewProvider->previewImage) {
            $imageSource = $this->imageSourceFactory->tryCreateForImageSourceProxy($previewProvider->previewImage);
            if ($imageSource === null) {
                return null;
            }
            return Figure::create(
                image: $imageSource,
                size: $figureSize,
                isLazyLoaded: true,
            );
        }

        return null;
    }
}
