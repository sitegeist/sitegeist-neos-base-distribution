<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Grid;

use Vendor\Shared\Presentation\Block\Text\TextFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class GridFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new Grid(
            GridVariant::VARIANT_REGULAR,
            Collection::fromSlots(...array_filter([
                TextFactory::getLoremIpsum(),
                TextFactory::getLoremIpsum()
            ]))
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
