<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use GuzzleHttp\Psr7\Uri;
use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\ReferenceName;
use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Model\Document;
use Neos\Media\Domain\Repository\DocumentRepository;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\CacheSegment;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;
use Vendor\Shared\Integration\ImageSourceFactory;
use Vendor\Shared\Presentation\Block\AccordionItem\AccordionItem;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Figure\FigureAspectRatio;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectFit;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectPosition;
use Vendor\Shared\Presentation\Block\Figure\FigureSize;
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
use Vendor\Shared\Presentation\Block\QuotationCard\QuotationCard;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\Block\VerticalCard\VerticalCard;
use Vendor\Shared\Presentation\Block\VerticalCard\VerticalCardVariant;
use Vendor\Shared\Presentation\ImageWithTextAlignment;
use Vendor\Shared\Presentation\ImageWithTextLayout;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Grid\Grid;
use Vendor\Shared\Presentation\Layout\Grid\GridVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;
use Vendor\Shared\Presentation\Block\Figure\FigureFactory;

final class ContentSlotFactory
{

    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
        private readonly ImageSourceFactory $imageSourceFactory,
        private readonly DocumentRepository $documentRepository,
        private readonly DownloadCardFactory $downloadCardFactory,
    ) {
    }
    public function forContentNode(
        Node $contentNode,
        Node $documentNode,
        Node $site,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return match ($contentNode->nodeTypeName->value) {
            'Vendor.WheelInventor:Content.Download'
                => $this->forDownloadNode($contentNode, $inBackend),
            'Vendor.WheelInventor:Content.DownloadList'
                => $this->forDownloadListNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.Downloads'
                => $this->forDownloadsNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.Image'
                => $this->forImageNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.ImageWithText'
                => $this->forImageWithTextNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.Text'
                => $this->forTextNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.Quotation'
                => $this->forQuotationNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.Accordion'
                => $this->forAccordionNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.AccordionItem'
                => $this->forAccordionItemNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.TileNavigation'
                => $this->forTileNavigationNode($contentNode, $subgraph, $inBackend),
            'Vendor.WheelInventor:Content.AnchorNavigation'
                => $this->forAnchorNavigationNode($contentNode, $subgraph),
            'Vendor.WheelInventor:Content.Anchor'
                => $this->forAnchorNode($contentNode, $inBackend),
            default => throw new \InvalidArgumentException(
                'Don\'t know how to render nodes of type ' . $contentNode->nodeTypeName->value,
                1726130732
            )
        };
    }

    public function forDownloadListNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        $query = $this->documentRepository->createQuery();
        $constraints = [];
        $assetCollectionIds = $contentNode->getProperty('assetCollections');
        if ($assetCollectionIds) {
            $constraints[] = $query->contains('assetCollections', $assetCollectionIds);
        }
        $tagIds = $contentNode->getProperty('tags');
        if ($tagIds) {
            $constraints[] = $query->contains('tags', $tagIds);
        }

        /** @var array<Document> $documents */
        $documents = $constraints
            ? $query->matching(
                $query->logicalAnd(...$constraints)
            )->execute()->toArray()
            : [];

        $umlautSearch = ['Ä','ä','Ö','ö','Ü','ü','ß'];
        $umlautReplace = ['A','a','O','o','U','u','ss'];

        uasort(
            $documents,
            fn (Document $documentA, Document $documentB)
            =>
                str_replace($umlautSearch, $umlautReplace, $documentA->getTitle())
                <=>
                str_replace($umlautSearch, $umlautReplace, $documentB->getTitle())
        );

        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                new Stack(
                    StackVariant::VARIANT_SPACE_Y_4,
                    Collection::fromSlots(... array_filter([
                        $contentNode->getProperty('headline') || $inBackend
                            ? new Headline(
                                HeadlineVariant::VARIANT_REGULAR,
                                HeadlineType::TYPE_H2,
                                Editable::fromNodeProperty($contentNode, 'headline')
                            )
                            : null,
                        new CacheSegment(
                            new Grid(
                                GridVariant::VARIANT_3_COL_GAP,
                                Collection::fromIterable(
                                    $documents,
                                    fn(Document $asset): SlotInterface
                                    => new ContentContainer(
                                        ContentContainerVariant::VARIANT_NONE,
                                        $this->downloadCardFactory->forAsset($asset, $inBackend, null)
                                    )
                                )
                            ),
                            'Vendor.WheelInventor:CacheSegment.DownloadList'
                        )
                    ]))
                )
            )
        );
    }

    public function forDownloadsNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_SPACE_Y_4,
                Collection::fromSlots(... array_filter([
                    $contentNode->getProperty('headline') || $inBackend
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H2,
                            Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    new Grid(
                        GridVariant::VARIANT_3_COL_GAP,
                        Collection::fromNodes(
                            $subgraph->findChildNodes($contentNode->aggregateId, FindChildNodesFilter::create()),
                            fn (Node $downloadNode): Content
                                => Content::fromNode($downloadNode, 'Vendor.WheelInventor:ContentSlot')
                        )
                    )
                ]))
            )
        );
    }

    public function forDownloadNode(Node $downloadNode, bool $inBackend): SlotInterface
    {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_NONE,
            $this->downloadCardFactory->forDownloadNode($downloadNode, $inBackend)
        );
    }

    public function forImageNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        $imageSource = $this->imageSourceFactory->tryFromImageMixin($contentNode, $inBackend);

        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(... array_filter([
                    $contentNode->getProperty('headline') || $inBackend
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H2,
                            Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    $imageSource
                        ? new Figure(
                            $imageSource,
                            true,
                            FigureSize::SIZE_FULL_FULL_FULL,
                            FigureObjectFit::FIT_COVER,
                            FigureObjectPosition::POSITION_CENTER,
                            FigureAspectRatio::RATIO_4X3
                        )
                        : null
                ]))
            )
        );
    }

    public function forImageWithTextNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        $alignment = ImageWithTextAlignment::from($contentNode->getProperty('alignment'));
        $textContent = new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(...array_filter([
                    $contentNode->getProperty('headline') || $inBackend
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H2,
                            Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    new Text(
                        TextColumns::from($contentNode->getProperty('columns')),
                        Editable::fromNodeProperty($contentNode, 'text')
                    ),
                    $this->linkedButtonFactory->tryForLinkMixin($contentNode, $subgraph, $inBackend),
                ]))
            )
        );

        $imageSource = $this->imageSourceFactory->tryFromImageMixin($contentNode, $inBackend);
        $layout = ImageWithTextLayout::from($contentNode->getProperty('layout'));
        $imageContent = new ContentContainer(
            $alignment === ImageWithTextAlignment::VARIANT_IMAGEFIRST
                ? ContentContainerVariant::VARIANT_NONE
                : ContentContainerVariant::VARIANT_REVERSE_ORDER,
            Collection::fromIterable(
                array_filter([
                    $imageSource
                        ? new Figure(
                            $imageSource,
                            true,
                            FigureSize::SIZE_FULL_FULL_FULL,
                            FigureObjectFit::FIT_COVER,
                            FigureObjectPosition::POSITION_CENTER,
                            FigureAspectRatio::RATIO_4X3
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

    public function forQuotationNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
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
                $this->uriService->getResourceUri('Vendor.WheelInventor', 'Images/quotation.svg'),
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

    public function forTextNode(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(... array_filter([
                    $contentNode->getProperty('headline') || $inBackend
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H2,
                            Editable::fromNodeProperty($contentNode, 'headline')
                        )
                        : null,
                    new Text(
                        TextColumns::from($contentNode->getProperty('columns')),
                        Editable::fromNodeProperty($contentNode, 'text')
                    ),
                    $this->linkedButtonFactory->tryForLinkMixin($contentNode, $subgraph, $inBackend),
                ]))
            )
        );
    }

    public function forAccordionNode(
        Node $accordionNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_SPACE_Y_4,
                Collection::fromSlots(... array_filter([
                    $inBackend || $accordionNode->getProperty('headline')
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H3,
                            Editable::fromNodeProperty($accordionNode, 'headline')
                        )
                        : null,
                    Collection::fromNodes(
                        $subgraph->findChildNodes($accordionNode->aggregateId, FindChildNodesFilter::create()),
                        function (Node $accordionItem): Content {
                            return Content::fromNode($accordionItem, 'Vendor.WheelInventor:ContentSlot');
                        }
                    )
                ]))
            )
        );
    }

    public function forAccordionItemNode(
        Node $accordionItemNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return new AccordionItem(
            Editable::fromNodeProperty($accordionItemNode, 'headline'),
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(...array_filter([
                    new Text(
                        TextColumns::from($accordionItemNode->getProperty('columns') ?: 'oneColumn'),
                        Editable::fromNodeProperty($accordionItemNode, 'text')
                    ),
                    $this->linkedButtonFactory->tryForLinkMixin($accordionItemNode, $subgraph, $inBackend)
                ]))
            ),
            Icon::specifiedWith(
                IconName::NAME_DASH,
                IconSize::SIZE_REGULAR,
                IconColor::COLOR_DEFAULT
            ),
            Icon::specifiedWith(
                IconName::NAME_PLUS,
                IconSize::SIZE_REGULAR,
                IconColor::COLOR_DEFAULT
            ),
            $accordionItemNode->getProperty('isAccordionOpen'),
            $inBackend
        );
    }

    public function forTileNavigationNode(
        Node $tileNavigationNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_SPACE_Y_4,
                Collection::fromSlots(... array_filter([
                    $inBackend || $tileNavigationNode->getProperty('headline')
                        ? new Headline(
                            HeadlineVariant::VARIANT_REGULAR,
                            HeadlineType::TYPE_H3,
                            Editable::fromNodeProperty($tileNavigationNode, 'headline')
                        )
                        : null,
                    new CacheSegment(
                        new Grid(
                            GridVariant::VARIANT_3_COL_GAP,
                            Collection::fromNodes(
                                $subgraph->findReferences(
                                    $tileNavigationNode->aggregateId,
                                    FindReferencesFilter::create(referenceName: ReferenceName::fromString('documents'))
                                )->getNodes(),
                                fn (Node $documentNode)
                                => new Link(
                                    variant: LinkVariant::VARIANT_REGULAR,
                                    href: $this->uriService->getNodeUri($documentNode),
                                    target: LinkTarget::TARGET_BLANK,
                                    title: $this->getNodeLabel($documentNode),
                                    content: new VerticalCard(
                                        VerticalCardVariant::VARIANT_REGULAR,
                                        $this->figureFactory->forNavigationCard(
                                            $documentNode
                                        ),
                                        new Headline(
                                            HeadlineVariant::VARIANT_REGULAR,
                                            HeadlineType::TYPE_DIV,
                                            Value::fromString(
                                                $documentNode->getProperty('previewHeadline')
                                                    ?: $this->getNodeLabel($documentNode)
                                            )
                                        ),
                                        new Text(
                                            TextColumns::COLUMNS_ONE_COLUMN,
                                            Value::fromString(
                                                $documentNode->getProperty('previewText')
                                                    ?: ($documentNode->getProperty('abstract') ?: '')
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
                                    inBackend: $inBackend,
                                )
                            )
                        ),
                        'Vendor.WheelInventor:CacheSegment.TileNavigation'
                    )
                ]))
            )
        );
    }

    public function forAnchorNavigationNode(
        Node $anchorNavigationNode,
        ContentSubgraphInterface $subgraph
    ): SlotInterface {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_HORIZONTAL_CENTERED,
                Collection::fromNodes(
                    $subgraph->findChildNodes($anchorNavigationNode->aggregateId, FindChildNodesFilter::create()),
                    fn(Node $anchor): Content
                    => Content::fromNode($anchor, 'Vendor.WheelInventor:ContentSlot')
                )
            )
        );
    }

    public function forAnchorNode(Node $anchorNode, bool $inBackend): SlotInterface
    {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_NONE,
            new Link(
                variant: LinkVariant::VARIANT_REGULAR,
                href: new Uri('#' . $anchorNode->getProperty('targetIdentifier')),
                target: LinkTarget::TARGET_SELF,
                title: $anchorNode->getProperty('anchorTitle') ?: '',
                content: new Button(
                    ButtonVariant::VARIANT_PIPE,
                    ButtonType::TYPE_REGULAR,
                    ButtonColor::COLOR_BRAND,
                    Editable::fromNodeProperty($anchorNode, 'title'),
                    null,
                    $inBackend
                ),
                inBackend: $inBackend
            )
        );
    }
}
