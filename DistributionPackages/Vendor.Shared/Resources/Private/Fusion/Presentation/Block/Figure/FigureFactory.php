<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\ContentRepository\Domain\Model\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Vendor\Shared\Integration\ImageSourceFactory;

final class FigureFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function __construct(
        public readonly ImageSourceFactory $imageSourceFactory
    ) {
    }

    public function forNavigationCard(Node $documentNode): Figure
    {
        $previewImageSource = $documentNode->getProperty('previewImage')
            ? $this->imageSourceFactory->tryFromImageMixinForProperty(
                $documentNode,
                'previewImage',
                true
            )
            : $this->imageSourceFactory->tryFromImageMixinForProperty(
                $documentNode,
                'image',
                true,
                null,
                true
            );

        if (! $previewImageSource) {
            throw new \InvalidArgumentException(
                'there is no preview Image for document ' . $documentNode->getProperty('title'),
                1669212737
            );
        }

        return new Figure(
            $previewImageSource,
            true,
            FigureSize::SIZE_FIFTH_HALF_FULL,
            FigureObjectFit::FIT_COVER,
            FigureObjectPosition::POSITION_CENTER,
            FigureAspectRatio::RATIO_4X3
        );
    }

    public function getDefaultCase(): SlotInterface
    {
        return new Figure(
            new DummyImageSource(
                (string)$this->uriService->getDummyImageBaseUri(),
                null,
                null,
                1920,
                1080,
                null,
            ),
            false,
            FigureSize::SIZE_FULL_FULL_FULL,
            FigureObjectFit::FIT_COVER,
            FigureObjectPosition::POSITION_CENTER,
            FigureAspectRatio::RATIO_4X3
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
