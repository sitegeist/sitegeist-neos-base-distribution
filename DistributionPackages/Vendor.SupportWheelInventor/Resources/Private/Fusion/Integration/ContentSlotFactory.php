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
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkFactory;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;

final class ContentSlotFactory extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly LinkFactory $linkFactory,
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
            'Vendor.SupportWheelInventor:Content.Text'
                => $this->forTextNode($contentNode, $subgraph, $inBackend),
            default => throw new \InvalidArgumentException(
                'Don\'t know how to render nodes of type ' . $contentNode->getNodeTypeName(),
                1664205952
            )
        };
    }

    public function forTextNode(
        Node $textNode,
        ContentContext $subgraph,
        bool $inBackend
    ): ContentContainer
    {

        $linkProperty = $textNode->getProperty('link__href');

        $href = $this->linkFactory->resolveRawLinkHref($linkProperty, $subgraph);

        return new ContentContainer(
            ContentContainerVariant::VARIANT_REGULAR,
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(... array_filter([
                    $textNode->getProperty('headline') || $inBackend
                        ? new Headline(
                        HeadlineVariant::VARIANT_REGULAR,
                        HeadlineType::TYPE_H2,
                        Editable::fromNodeProperty($textNode, 'headline')
                    )
                        : null,
                    new Text(
                        TextColumns::from($textNode->getProperty('columns')),
                        Editable::fromNodeProperty($textNode, 'text')
                    ),
                    $href
                        ? new ContentContainer(
                        ContentContainerVariant::VARIANT_REGULAR,
                        new Link(
                            LinkVariant::VARIANT_REGULAR,
                            $href,
                            $textNode->getProperty('link__label') ?: '',
                            LinkFactory::resolveLinkTargetForRawLinkHref(
                                $linkProperty,
                                $subgraph
                            ),
                            new Button(
                                ButtonVariant::VARIANT_SOLID,
                                ButtonType::TYPE_REGULAR,
                                ButtonColor::COLOR_BRAND,
                                Value::fromString($textNode->getProperty('link__label') ?: ''),
                                Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR),
                                $inBackend
                            ),
                            $inBackend
                        )
                    )
                        : null
                ]))
            )
        );
    }
}
