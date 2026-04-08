<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\Accordion;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;

final class AccordionRenderer extends AbstractComponentPresentationObjectFactory
{
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
                    Collection::fromNodes(
                        $subgraph->findChildNodes($contentNode->aggregateId, FindChildNodesFilter::create()),
                    )
                ]))
            )
        );
    }
}
