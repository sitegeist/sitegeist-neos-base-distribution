<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Domain;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\ContentRepository\Domain\NodeType\NodeTypeConstraintFactory;
use Neos\ContentRepository\Domain\Projection\Content\TraversableNodeInterface;
use Neos\Flow\Annotations as Flow;

class Sailor
{
    #[Flow\Inject]
    protected NodeTypeConstraintFactory $nodeTypeConstraintFactory;

    /**
     * @return array<int,string>
     */
    public function findAvailableNeighbouringAnchors(NodeInterface $contentNode): array
    {
        /** @var TraversableNodeInterface $contentNode */
        $documentNode = $contentNode->findParentNode();
        $availableAnchors = [];

        while (!$documentNode->getNodeType()->isOfType('Neos.Neos:Document') && !$documentNode->isRoot()) {
            $documentNode = $documentNode->findParentNode();
        }

        $firstLevelContentCollections = $this->findFirstLevelContentCollections($documentNode);

        foreach ($firstLevelContentCollections as $firstLevelContentCollection) {
            $availableAnchors = array_merge(
                $availableAnchors,
                $this->findAnchorsInCollection($firstLevelContentCollection)
            );
        }

        sort($availableAnchors);

        return $availableAnchors;
    }

    /**
     * @return array<int,string>
     */
    protected function findAnchorsInCollection(TraversableNodeInterface $contentCollectionNode): array
    {
        $anchors = array_map(
            fn(TraversableNodeInterface $contentNode)
            => $contentNode->getProperty('anchorID') ?: null,
            $contentCollectionNode->findChildNodes()->toArray()
        );

        return array_filter($anchors);
    }

    /**
     * @return array<int,TraversableNodeInterface>
     */
    protected function findFirstLevelContentCollections(TraversableNodeInterface $documentNode): array
    {
        $firstLevelContentCollections = [];

        foreach ($documentNode->findChildNodes(
            $this->nodeTypeConstraintFactory->parseFilterString(
                'Neos.Neos:ContentCollection'
            )
        ) as $collection
        ) {
            /** @var TraversableNodeInterface $collection */
            if ($collection->findParentNode() === $documentNode) {
                $firstLevelContentCollections[] = $collection;
            }
        }

        return $firstLevelContentCollections;
    }
}
