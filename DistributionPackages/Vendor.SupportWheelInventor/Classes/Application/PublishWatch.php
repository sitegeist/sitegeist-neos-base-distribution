<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Application;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Vendor\SupportWheelInventor\Domain\Sailor;

class PublishWatch
{
    public function watchForRedundantContentElementIdentifier(NodeInterface $node): void
    {
        if ($node->getNodeType()->isOfType('Neos.Neos:Content') && $node->getProperty('anchorID')) {
            $availableAnchors = (new Sailor())->findAvailableNeighbouringAnchors($node);

            if (count($availableAnchors) !== count(array_unique($availableAnchors))) {
                throw new \Exception("There are already content elements with the same anchor id", 1703878649);
            }
        }
    }
}
