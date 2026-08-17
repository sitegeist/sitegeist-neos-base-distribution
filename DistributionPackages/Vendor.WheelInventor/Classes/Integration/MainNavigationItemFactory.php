<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindSubtreeFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Subtree;
use Neos\Neos\Domain\NodeLabel\NodeLabelGeneratorInterface;
use Neos\Neos\NodeTypes\Document;
use Neos\Neos\NodeTypes\Site;
use PackageFactory\ComponentEngine\ComponentList;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use PackageFactory\OPGM\Infrastructure\NodeTypeNameExtractor;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationItem\MainNavigationItem;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationSubItem\MainNavigationSubItem;
use Vendor\WheelInventor\NodeTypes\Tag\MainNavigationElement;

final class MainNavigationItemFactory
{
    public function __construct(
        private readonly NodeLabelGeneratorInterface $nodeLabelGenerator
    ) {
    }

    /**TODO: add cache segment */

    public const MAX_NAVIGATION_DEPTH = 2;

    /**
     * @return ComponentList<MainNavigationItem>|null
     */
    public function fromRootNode(
        Site $site,
        ContentSubgraphInterface $subgraph,
        NeosAccessInterface $neosAccess
    ): ?ComponentList {
        $subtree = $subgraph->findSubtree(
            $site->node->aggregateId,
            FindSubtreeFilter::create(
                NodeTypeNameExtractor::requireFromFQN(MainNavigationElement::class)->value,
                self::MAX_NAVIGATION_DEPTH
            )
        );

        if ($subtree === null) {
            return null;
        }

        /** @var list<MainNavigationItem> $childNavigationItems */
        $childNavigationItems = [];
        foreach ($subtree->children as $child) {
            $item = $this->createMainNavigationItemFromSubtree(
                $child,
                $subgraph,
                $neosAccess
            );
            if (!$item instanceof MainNavigationItem) {
                continue;
            }

            $childNavigationItems[] = $item;
        };

        return ComponentList::list(...$childNavigationItems);
    }

    private function createMainNavigationItemFromSubtree(
        Subtree $subtree,
        ContentSubgraphInterface $subgraph,
        NeosAccessInterface $neos,
        int $level = 1
    ): MainNavigationItem|MainNavigationSubItem|null {
        $childNavigationItems = [];

        $document = ObjectPropertyGraphMapper::map($subtree->node, $subgraph);
        if (!$document instanceof Document || $document->hiddenInMenu) {
            return null;
        }

        foreach ($subtree->children as $child) {
            $menuItem = $this->createMainNavigationItemFromSubtree(
                $child,
                $subgraph,
                $neos,
                $level + 1
            );
            if ($menuItem) {
                $childNavigationItems[] = $menuItem;
            }
        }

        $linkStruct = LinkStruct::create(
            href: (string)$neos->getNodeUri($subtree->node),
            title: null,
            rel: null,
            target: LinkTarget::TARGET_SELF
        );

        if ($level === 1) {
            return MainNavigationItem::create(
                link: $linkStruct,
                label: $this->nodeLabelGenerator->getLabel($subtree->node),
                items: ComponentList::list(...$childNavigationItems)
            );
        } else {
            return MainNavigationSubItem::create(
                link: $linkStruct,
                label: $this->nodeLabelGenerator->getLabel($subtree->node)
            );
        }
    }
}
