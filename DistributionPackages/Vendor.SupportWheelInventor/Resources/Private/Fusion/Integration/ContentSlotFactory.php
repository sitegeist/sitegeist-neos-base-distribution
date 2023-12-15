<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Domain\Model\Node;
use Neos\Neos\Domain\Service\ContentContext;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Integration\ImageSourceFactory;
use Vendor\Shared\Presentation\Block\AccordionItem\AccordionItem;
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

final class ContentSlotFactory extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
        private readonly ImageSourceFactory $imageSourceFactory,
    ) {
    }
    public function forContentNode(
        Node $contentNode,
        Node $documentNode,
        Node $site,
        ContentContext $subgraph,
        bool $inBackend
    ): SlotInterface {
        return match ((string) $contentNode->getNodeTypeName()) {
            'Vendor.SupportWheelInventor:Content.Image'
                => $this->forImageNode($contentNode, $subgraph, $inBackend),
            'Vendor.SupportWheelInventor:Content.ImageWithText'
                => $this->forImageWithTextNode($contentNode, $subgraph, $inBackend),
            'Vendor.SupportWheelInventor:Content.Text'
                => $this->forTextNode($contentNode, $subgraph, $inBackend),
            'Vendor.SupportWheelInventor:Content.Accordion'
                => $this->forAccordionNode($contentNode, $subgraph, $inBackend),
            'Vendor.SupportWheelInventor:Content.AccordionItem'
                => $this->forAccordionItemNode($contentNode, $subgraph, $inBackend),
            default => throw new \InvalidArgumentException(
                'Don\'t know how to render nodes of type ' . $contentNode->getNodeTypeName(),
                1664205952
            )
        };
    }

    public function forImageNode(
        Node $contentNode,
        ContentContext $subgraph,
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
        ContentContext $subgraph,
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

    public function forTextNode(
        Node $contentNode,
        ContentContext $subgraph,
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
        ContentContext $subgraph,
        bool $inBackend
    ): SlotInterface
    {
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
                        $accordionNode->findChildNodes(),
                        function (Node $accordionItem): Content {
                            return Content::fromNode($accordionItem, 'Vendor.SupportWheelInventor:ContentSlot');
                        }
                    )
                ]))
            )
        );

    }

    public function forAccordionItemNode(
        Node $accordionItemNode,
        ContentContext $subgraph,
        bool $inBackend
    ): SlotInterface
    {
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
}
