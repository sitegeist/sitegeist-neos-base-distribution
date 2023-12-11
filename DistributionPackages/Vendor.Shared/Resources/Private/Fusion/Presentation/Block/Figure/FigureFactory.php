<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;

final class FigureFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
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
