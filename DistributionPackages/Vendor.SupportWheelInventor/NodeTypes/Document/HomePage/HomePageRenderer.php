<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Document\HomePage;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Presentation\Layout\Page\Page;

final class HomePageRenderer extends AbstractComponentPresentationObjectFactory
{
    public function renderAsDocument(
        Node $documentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): Page {
        $mainContentCollection = $subgraph->findNodeByPath(
            NodeName::fromString('main'),
            $documentNode->aggregateId
        );

        return new Page(
            Collection::fromSlots(
                $mainContentCollection
                    ? Content::fromNode($mainContentCollection)
                    : Value::fromString(''),
            )
        );
    }
}
