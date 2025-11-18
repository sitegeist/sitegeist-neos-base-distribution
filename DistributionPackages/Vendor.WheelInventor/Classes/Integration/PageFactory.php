<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use Vendor\Shared\Presentation\Layout\Page\Page;

final class PageFactory
{
    public function forHomePage(
        Node $homePage,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            Collection::fromSlots(
                Content::fromNode($this->getMainContentCollection($subgraph, $homePage))
            )
        );
    }

    public function forWebPage(
        Node $homePage,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            Collection::fromSlots(
                Content::fromNode($this->getMainContentCollection($subgraph, $homePage))
            )
        );
    }

    public function for404Page(
        Node $errorPage,
        Node $site,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            Collection::fromSlots(
                Content::fromNode($this->getMainContentCollection($subgraph, $errorPage))
            )
        );
    }

    private function getMainContentCollection(ContentSubgraphInterface $subgraph, Node $documentNode): Node
    {
        $mainContentCollection = $subgraph->findNodeByPath(
            NodeName::fromString('main'),
            $documentNode->aggregateId,
        );
        assert($mainContentCollection instanceof Node);

        return $mainContentCollection;
    }
}
