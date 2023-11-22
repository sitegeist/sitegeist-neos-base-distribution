<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\ContentContainer;

use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class ContentContainerFactory extends AbstractComponentPresentationObjectFactory implements
    StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Text(
                TextFactory::getLoremIpsum()
            )
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
