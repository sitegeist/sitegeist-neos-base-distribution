<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Application;

use Neos\ContentRepository\Core\DimensionSpace\DimensionSpacePoint;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;
use Neos\Eel\ProtectedContextAwareInterface;

final class NotFoundResolver implements ProtectedContextAwareInterface
{
    public function __construct(
        private readonly ContentRepositoryRegistry $contentRepositoryRegistry,
    ) {
    }

    public function resolve(
        Node $siteNode
    ): ?Node {
        $contentGraph = $this->contentRepositoryRegistry->get($siteNode->contentRepositoryId)
            ->getContentGraph($siteNode->workspaceName);
        $subgraph = $contentGraph->getSubgraph(
            DimensionSpacePoint::createWithoutDimensions(),
            $siteNode->visibilityConstraints,
        );

        return $subgraph->findNodeByPath(
            path: NodeName::fromString('notfound'),
            startingNodeAggregateId: $siteNode->aggregateId,
        );
    }

    /**
     * @param string $methodName
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
