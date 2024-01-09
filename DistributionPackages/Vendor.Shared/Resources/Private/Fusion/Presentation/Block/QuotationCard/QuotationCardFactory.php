<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\QuotationCard;

use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Figure\FigureAspectRatio;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectFit;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectPosition;
use Vendor\Shared\Presentation\Block\Figure\FigureSize;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

#[Flow\Scope('singleton')]
final class QuotationCardFactory extends AbstractComponentPresentationObjectFactory implements
    StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new QuotationCard(
            $this->uriService->getResourceUri('Vendor.SupportWheelInventor', 'Images/quotation.svg'),
            new Figure(
                new DummyImageSource(
                    (string)$this->uriService->getDummyImageBaseUri(),
                    null,
                    null,
                    1080,
                    1080,
                    null,
                ),
                false,
                FigureSize::SIZE_FULL_FULL_FULL,
                FigureObjectFit::FIT_COVER,
                FigureObjectPosition::POSITION_CENTER,
                FigureAspectRatio::RATIO_1X1
            ),
            Value::fromString('Ich hack\' ein Loch in unser Raumschiff'),
            Value::fromString('Die olle Blecheule'),
            Value::fromString('Copilot'),
            new Text(
                TextColumns::COLUMNS_ONE_COLUMN,
                Value::fromString('© Vendor'),
            )
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
