<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\Quotation;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Media\Domain\Model\Asset;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;
use Vendor\Shared\Integration\ImageSourceFactory;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Figure\FigureAspectRatio;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectFit;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectPosition;
use Vendor\Shared\Presentation\Block\Figure\FigureSize;
use Vendor\Shared\Presentation\Block\QuotationCard\QuotationCard;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;

final class QuotationRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly ImageSourceFactory $imageSourceFactory,
    ) {
    }

    public function renderAsContent(
        Node $contentNode,
        Node $documentNode,
        Node $siteNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface {
        $image = $contentNode->getProperty('image');
        $imageSource = $this->imageSourceFactory->tryFromImageMixin($contentNode, $inBackend);
        $figure = $imageSource instanceof ImageSourceInterface
            ? new Figure(
                $imageSource,
                true,
                FigureSize::SIZE_THIRD_HALF_FULL,
                FigureObjectFit::FIT_COVER,
                FigureObjectPosition::POSITION_TOP,
                FigureAspectRatio::RATIO_1X1,
            )
            : null;

        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new QuotationCard(
                $this->uriService->getResourceUri('Vendor.SupportWheelInventor', 'Images/quotation.svg'),
                $figure,
                Editable::fromNodeProperty($contentNode, 'spokenByCharacter__name'),
                Editable::fromNodeProperty($contentNode, 'spokenByCharacter__jobTitle'),
                Editable::fromNodeProperty($contentNode, 'text'),
                $image instanceof Asset && $image->getCopyrightNotice()
                    ? new Text(
                        TextColumns::COLUMNS_ONE_COLUMN,
                        Value::fromString("© " . $image->getCopyrightNotice()),
                    )
                    : null
            )
        );
    }
}
