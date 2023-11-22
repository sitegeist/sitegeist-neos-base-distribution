<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class RowFactory extends AbstractComponentPresentationObjectFactory implements StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new Row(
            RowVariant::VARIANT_REGULAR,
            RowJustification::JUSTIFY_START,
            RowAlignment::ALIGN_ITEMS_START,
            Value::fromString('')
        );
    }

    public function getUseCases(): \Traversable
    {
        yield 'Row ohne Gap' => new Row(
            RowVariant::VARIANT_REGULAR,
            RowJustification::JUSTIFY_START,
            RowAlignment::ALIGN_ITEMS_START,
            Value::fromString('')
        );
    }
}
