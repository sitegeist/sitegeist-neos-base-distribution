<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindChildNodesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Presentation\Block\NavigationItem\NavigationItem;
use Vendor\Shared\Presentation\Block\NavigationItem\NavigationItems;

final class NavigationItemFactory extends AbstractComponentPresentationObjectFactory
{
    public const MAX_NAVIGATION_DEPTH = 2;
    public const MAX_ITEMS_PER_COLUMN = 6;

    public function forNavigationNode(
        Node $rootNode,
        Node $currentDocumentNode,
        ContentSubgraphInterface $subgraph,
        int $currentLevel
    ): ?NavigationItems {
        if ($currentLevel <= self::MAX_NAVIGATION_DEPTH) {
            $childNodes = array_filter(
                array_map(
                    function (
                        Node $node
                    ) use (
                        $currentDocumentNode,
                        $currentLevel,
                        $subgraph,
                    ): ?NavigationItem {
                        if ($node->getProperty('hiddenInMenu')) {
                            return null;
                        }
                        try {
                            return new NavigationItem(
                                uri: $this->uriService->getNodeUri($node),
                                label: Value::fromString($this->getNodeLabel($node)),
                                isActive: false,
                                items: $this->forNavigationNode(
                                    $node,
                                    $currentDocumentNode,
                                    $subgraph,
                                    ++$currentLevel
                                )
                            );
                        } catch (\Exception) {
                            return null;
                        }
                    },
                    iterator_to_array($subgraph->findChildNodes(
                        $rootNode->aggregateId,
                        filter: FindChildNodesFilter::create(
                            nodeTypes: 'Vendor.SupportWheelInventor:Tag.MainNavigationElement'
                        )
                    ))
                )
            );

            return new NavigationItems(...$childNodes);
        }
        return null;
    }
}
