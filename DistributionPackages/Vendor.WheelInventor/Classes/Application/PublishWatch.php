<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Application;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;
use Neos\Flow\Annotations as Flow;
use Vendor\WheelInventor\Domain\Sailor;

class PublishWatch
{
    public function __construct(
        private readonly ContentRepositoryRegistry $contentRepositoryRegistry,
        private readonly Sailor $sailor,
    ) {
    }

    public function watchForRedundantContentElementIdentifier(Node $node): void
    {
        $nodeTypeManager = $this->contentRepositoryRegistry->get($node->contentRepositoryId)->getNodeTypeManager();
        if (
            $nodeTypeManager->getNodeType($node->nodeTypeName)?->isOfType('Neos.Neos:Content')
            && $node->getProperty('anchorID')
        ) {
            $availableAnchors = $this->sailor->findAvailableNeighbouringAnchors($node);

            if (count($availableAnchors) !== count(array_unique($availableAnchors))) {
                throw new \Exception("There are already content elements with the same anchor id", 1703878649);
            }
        }
    }
}
