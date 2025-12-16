<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\VerticalCard;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;
use Vendor\Shared\Presentation\Block\AccordionItem\AccordionItem;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;
use Vendor\Shared\Presentation\Block\Text\TextFactory;

final class VerticalCardFactory extends AbstractComponentPresentationObjectFactory implements
    StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new AccordionItem(
            Value::fromString("Ich bin die Headline"),
            TextFactory::getLoremIpsum(),
            Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT),
            Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT),
            true,
            false
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
