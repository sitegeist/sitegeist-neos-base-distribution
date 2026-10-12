<?php

declare(strict_types=1);

namespace Vendor\Site\Domain;

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
        $availableAnchors = [];
        foreach ($this->findAnchorNodes($contentNode) as $anchorNode) {
            $availableAnchors[] = $anchorNode->getProperty('anchorId');
        }

        sort($availableAnchors);

        return $availableAnchors;
    }

    /**
     * The anchor labels of the document, falling back to the anchor id
     *
     * @return array<string,string> anchor id => label
     */
    public function findAvailableAnchorLabels(Node $contentNode): array
    {
        $anchorLabels = [];
        foreach ($this->findAnchorNodes($contentNode) as $anchorNode) {
            $anchorId = $anchorNode->getProperty('anchorId');
            $anchorLabels[$anchorId] = $anchorNode->getProperty('anchorLabel') ?: $anchorId;
        }

        ksort($anchorLabels);

        return $anchorLabels;
    }

    /**
     * The content elements with an anchor id in the first level content collections of
     * the closest document
     *
     * @return iterable<Node>
     */
    private function findAnchorNodes(Node $contentNode): iterable
    {
        $subgraph = $this->contentRepositoryRegistry->subgraphForNode($contentNode);
        $documentNode = $subgraph->findClosestNode(
            $contentNode->aggregateId,
            FindClosestNodeFilter::create(nodeTypes: 'Neos.Neos:Document')
        );

        if (!$documentNode) {
            return;
        }

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
                ) as $anchorNode
            ) {
                if ($anchorNode->getProperty('anchorId')) {
                    yield $anchorNode;
                }
            }
        }
    }
}
