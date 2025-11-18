<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Domain;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindClosestNodeFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;

class Sailor
{
    public function __construct(
        private readonly ContentRepositoryRegistry $contentRepositoryRegistry,
    ) {
    }

    /**
     * @return array<int,string>
     */
    public function findAvailableNeighbouringAnchors(Node $contentNode): array
    {
        $subgraph = $this->contentRepositoryRegistry->subgraphForNode($contentNode);
        $documentNode = $subgraph->findClosestNode(
            $contentNode->aggregateId,
            FindClosestNodeFilter::create(nodeTypes: 'Neos.Neos:Document')
        );

        if (!$documentNode) {
            return [];
        }

        $availableAnchors = [];
        foreach (
            $subgraph->findChildNodes(
                $documentNode->aggregateId,
                FindChildNodesFilter::create(nodeTypes: 'Neos.Neos:ContentCollection')
            ) as $firstLevelContentCollection
        ) {
            foreach (
                $subgraph->findChildNodes(
                    $firstLevelContentCollection->aggregateId,
                    FindChildNodesFilter::create()
                ) as $contentNode
            ) {
                if ($contentNode->getProperty('anchorID')) {
                    $availableAnchors[] = $contentNode->getProperty('anchorID');
                }
            }
        }

        sort($availableAnchors);

        return $availableAnchors;
    }
}
