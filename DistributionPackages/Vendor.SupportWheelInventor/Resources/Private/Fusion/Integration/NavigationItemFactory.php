<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\ContentRepository\Domain\Projection\Content\TraversableNodeInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Presentation\Block\NavigationItem\NavigationItem;
use Vendor\Shared\Presentation\Block\NavigationItem\NavigationItems;

final class NavigationItemFactory extends AbstractComponentPresentationObjectFactory
{
    public const MAX_NAVIGATION_DEPTH = 2;
    public const MAX_ITEMS_PER_COLUMN = 6;

    /**
     * @return NavigationItems|null
     */
    public function forNavigationNode(
        TraversableNodeInterface $rootNode,
        TraversableNodeInterface $currentDocumentNode,
        int $currentLevel
    ): ?NavigationItems {
        if ($currentLevel <= self::MAX_NAVIGATION_DEPTH) {
            $childNodes = array_filter(
                array_map(
                    function (
                        TraversableNodeInterface $node
                    ) use (
                        $currentDocumentNode,
                        $currentLevel
                    ): ?NavigationItem {
                        if ($node instanceof NodeInterface && $node->isHiddenInIndex()) {
                            return null;
                        }
                        try {
                            return new NavigationItem(
                                uri: $this->uriService->getNodeUri($node),
                                label: Value::fromString($node->getLabel()),
                                isActive: \mb_strpos(
                                    (string)$currentDocumentNode->findNodePath(),
                                    (string)$node->findNodePath()
                                ) === 0,
                                items: $this->forNavigationNode(
                                    $node,
                                    $currentDocumentNode,
                                    ++$currentLevel
                                )
                            );
                        } catch (\Exception) {
                            return null;
                        }
                    },
                    $this->findChildNodesByNodeTypeFilterString(
                        $rootNode,
                        'Vendor.SupportWheelInventor:Tag.MainNavigationElement'
                    )->toArray()
                )
            );

            return new NavigationItems(...$childNodes);
        }
        return null;
    }
}
