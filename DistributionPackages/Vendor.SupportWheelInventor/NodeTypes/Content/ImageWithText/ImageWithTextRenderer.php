<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\ImageWithText;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Integration\ImageSourceFactory;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Figure\FigureAspectRatio;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectFit;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectPosition;
use Vendor\Shared\Presentation\Block\Figure\FigureSize;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\ImageWithTextAlignment;
use Vendor\Shared\Presentation\ImageWithTextLayout;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Grid\Grid;
use Vendor\Shared\Presentation\Layout\Grid\GridVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;
use Vendor\SupportWheelInventor\Integration\LinkedButtonFactory;

final class ImageWithTextRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly ImageSourceFactory $imageSourceFactory,
        private readonly LinkedButtonFactory $linkedButtonFactory,
    ) {
    }

    public function renderAsContent(
        Node $contentNode,
        Node $documentNode,
        Node $siteNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface {
        $alignment = ImageWithTextAlignment::from(
            self::getStringValue($contentNode, 'alignment')
                ?: ImageWithTextAlignment::VARIANT_IMAGEFIRST->value
        );
        $textContent = new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(...array_filter([
                    $contentNode->getProperty('headline') || $inBackend
                        ? new Headline(
                            variant: HeadlineVariant::VARIANT_REGULAR,
                            type: HeadlineType::TYPE_H2,
                            content: Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    new Text(
                        columns: TextColumns::from(
                            self::getStringValue($contentNode, 'columns')
                                ?: TextColumns::COLUMNS_ONE_COLUMN->value,
                        ),
                        content: Editable::fromNodeProperty($contentNode, 'text')
                    ),
                    $this->linkedButtonFactory->tryForLinkMixin($contentNode, $subgraph, $inBackend),
                ]))
            )
        );

        $imageSource = $this->imageSourceFactory->tryFromImageMixin($contentNode, $inBackend);
        $layout = ImageWithTextLayout::from(
            self::getStringValue($contentNode, 'layout')
                ?: ImageWithTextLayout::VARIANT_50_50->value
        );
        $imageContent = new ContentContainer(
            variant: $alignment === ImageWithTextAlignment::VARIANT_IMAGEFIRST
                ? ContentContainerVariant::VARIANT_NONE
                : ContentContainerVariant::VARIANT_REVERSE_ORDER,
            content: Collection::fromIterable(
                array_filter([
                    $imageSource
                        ? new Figure(
                            imageSource: $imageSource,
                            isLazyLoaded: true,
                            size: FigureSize::SIZE_FULL_FULL_FULL,
                            objectFit: FigureObjectFit::FIT_COVER,
                            objectPosition: FigureObjectPosition::POSITION_CENTER,
                            aspectRatio: FigureAspectRatio::RATIO_4X3,
                        )
                        : null
                ])
            )
        );

        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Grid(
                GridVariant::from($layout->value),
                $alignment === ImageWithTextAlignment::VARIANT_IMAGEFIRST
                    ? Collection::fromIterable([$imageContent, $textContent])
                    : Collection::fromIterable([$textContent, $imageContent])
            )
        );
    }
}
