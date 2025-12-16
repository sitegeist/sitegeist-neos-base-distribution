<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\TileNavigation;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\ReferenceName;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\CacheSegment;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Figure\FigureFactory;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\Block\VerticalCard\VerticalCard;
use Vendor\Shared\Presentation\Block\VerticalCard\VerticalCardVariant;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Grid\Grid;
use Vendor\Shared\Presentation\Layout\Grid\GridVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;
use Vendor\SupportWheelInventor\Integration\LinkedButtonFactory;

final class TileNavigationRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly FigureFactory $figureFactory,
    ) {
    }

    public function renderAsContent(
        Node $contentNode,
        Node $documentNode,
        Node $siteNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_SPACE_Y_4,
                Collection::fromSlots(... array_filter([
                    $inBackend || $contentNode->getProperty('headline')
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H3,
                            Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    new CacheSegment(
                        new Grid(
                            GridVariant::VARIANT_3_COL_GAP,
                            Collection::fromNodes(
                                $subgraph->findReferences(
                                    $contentNode->aggregateId,
                                    FindReferencesFilter::create(
                                        referenceName: ReferenceName::fromString('documents')
                                    )
                                )->getNodes(),
                                fn (Node $documentNode) => new Link(
                                    LinkVariant::VARIANT_REGULAR,
                                    ArchaeopteryxLink::create(
                                        $this->uriService->getNodeUri($documentNode),
                                        $this->getNodeLabel($documentNode),
                                        LinkTarget::TARGET_BLANK->value,
                                        ['noopener', 'nofollow'],
                                    ),
                                    new VerticalCard(
                                        VerticalCardVariant::VARIANT_REGULAR,
                                        $this->figureFactory->forNavigationCard(
                                            $documentNode
                                        ),
                                        new Headline(
                                            HeadlineVariant::VARIANT_REGULAR,
                                            HeadlineType::TYPE_DIV,
                                            Value::fromString(
                                                self::getStringValue($documentNode, 'previewHeadline')
                                                    ?: $this->getNodeLabel($documentNode)
                                            )
                                        ),
                                        new Text(
                                            TextColumns::COLUMNS_ONE_COLUMN,
                                            Value::fromString(
                                                self::getStringValue($documentNode, 'previewText')
                                                    ?: self::getStringValue($documentNode, 'abstract')
                                                    ?: ''
                                            )
                                        ),
                                        new Button(
                                            ButtonVariant::VARIANT_SOLID,
                                            ButtonType::TYPE_REGULAR,
                                            ButtonColor::COLOR_BRAND,
                                            Value::fromString('mehr erfahren'),
                                            Icon::specifiedWith(
                                                IconName::NAME_ARROW_RIGHT,
                                                IconSize::SIZE_REGULAR,
                                                IconColor::COLOR_DEFAULT
                                            ),
                                            $inBackend
                                        ),
                                    ),
                                    $inBackend
                                )
                            )
                        ),
                        'Vendor.SupportWheelInventor:CacheSegment.TileNavigation'
                    )
                ]))
            )
        );
    }
}
