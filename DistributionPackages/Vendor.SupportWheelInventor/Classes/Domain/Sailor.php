<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Domain;

use Neos\ContentRepository\Core\NodeType\NodeType;
use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;
use Neos\Flow\Annotations as Flow;

class Sailor
{
    #[Flow\Inject]
    protected ContentRepositoryRegistry $contentRepositoryRegistry;

    /**
     * @return array<int,string>
     */
    public function findAvailableNeighbouringAnchors(Node $contentNode): array
    {
        $subgraph = $this->contentRepositoryRegistry->subgraphForNode($contentNode);
        $documentNode = $subgraph->findParentNode($contentNode->aggregateId);
        $availableAnchors = [];

        while ($documentNode
            && !($this->getNodeType($documentNode)?->isOfType('Neos.Neos:Document'))
            && !$documentNode->classification->isRoot()
        ) {
            $documentNode = $subgraph->findParentNode($documentNode->aggregateId);
        }

        if (!$documentNode) {
            return [];
        }

        $firstLevelContentCollections = $subgraph->findChildNodes(
            $documentNode->aggregateId,
            FindChildNodesFilter::create(
                nodeTypes: 'Neos.Neos:ContentCollection'
            )
        );

        foreach ($firstLevelContentCollections as $firstLevelContentCollection) {
            $availableAnchors = array_merge(
                $availableAnchors,
                $this->findAnchorsInCollection($firstLevelContentCollection, $subgraph)
            );
        }
        sort($availableAnchors);

        return $availableAnchors;
    }

    /**
     * @return array<int,string>
     */
    protected function findAnchorsInCollection(Node $contentCollectionNode, ContentSubgraphInterface $subgraph): array
    {
        $anchors = array_map(
            fn (Node $contentNode): ?string => is_string(($anchorId = $contentNode->getProperty('anchorID')))
                ? $anchorId
                : null,
            iterator_to_array($subgraph->findChildNodes(
                parentNodeAggregateId: $contentCollectionNode->aggregateId,
                filter: FindChildNodesFilter::create()
            ))
        );

        return array_filter($anchors);
    }

    protected function getNodeType(Node $node): ?NodeType
    {
        return $this->contentRepositoryRegistry->get($node->contentRepositoryId)
            ->getNodeTypeManager()
            ->getNodeType($node->nodeTypeName);
    }
}
