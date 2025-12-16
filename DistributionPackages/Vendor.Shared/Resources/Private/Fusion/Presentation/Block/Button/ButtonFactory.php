<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Neos\Flow\Annotations as Flow;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;

final class ButtonFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new Button(
            ButtonVariant::VARIANT_SOLID,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString('Button Text'),
            null,
            false
        );
    }

    public function getUseCases(): \Traversable
    {
        yield 'Brand Button' => new Button(
            ButtonVariant::VARIANT_SOLID,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString('Button Text'),
            null,
            false
        );

        yield 'Button With Icon' => new Button(
            ButtonVariant::VARIANT_SOLID,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString('Button Text'),
            Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT),
            false
        );
    }
}
