<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\AnchorNavigation;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;

final class AnchorNavigationRenderer extends AbstractComponentPresentationObjectFactory
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
                StackVariant::VARIANT_HORIZONTAL_CENTERED,
                Collection::fromNodes(
                    $subgraph->findChildNodes($contentNode->aggregateId, FindChildNodesFilter::create()),
                )
            )
        );
    }
}
