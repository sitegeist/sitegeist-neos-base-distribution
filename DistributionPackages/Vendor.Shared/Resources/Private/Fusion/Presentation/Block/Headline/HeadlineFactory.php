<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Headline;

use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class HeadlineFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new Headline(
            HeadlineVariant::VARIANT_REGULAR,
            HeadlineType::TYPE_H1,
            Value::fromString('Überschrift Test')
        );
    }

    public function getUseCases(): \Traversable
    {
        yield 'Headline regular | H2 | L' => new Headline(
            HeadlineVariant::VARIANT_REGULAR,
            HeadlineType::TYPE_H2,
            Value::fromString('Headline')
        );
    }
}
