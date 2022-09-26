<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Domain\Model\Node;
use Neos\Neos\Domain\Service\ContentContext;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;

final class ContentSlotFactory extends AbstractComponentPresentationObjectFactory
{
    public function forContentNode(
        Node $contentNode,
        Node $documentNode,
        Node $site,
        ContentContext $subgraph,
        bool $inBackend
    ): SlotInterface {
        return match ((string) $contentNode->getNodeTypeName()) {
            default => throw new \InvalidArgumentException(
                'Don\'t know how to render nodes of type ' . $contentNode->getNodeTypeName(),
                1664205952
            )
        };
    }
}
