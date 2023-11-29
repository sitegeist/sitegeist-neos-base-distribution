<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Icon;

use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class IconFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR);
    }

    public function getUseCases(): \Traversable
    {
        yield 'Arrow Right' => Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR);
    }
}
