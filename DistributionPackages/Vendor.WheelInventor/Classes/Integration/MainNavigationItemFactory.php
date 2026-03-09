<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindSubtreeFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Subtree;
use Neos\Neos\Domain\NodeLabel\NodeLabelGeneratorInterface;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationItem\MainNavigationItem;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationSubItem\MainNavigationSubItem;

final class MainNavigationItemFactory
{
    public function __construct(
        private readonly NodeLabelGeneratorInterface $nodeLabelGenerator
    ) {
    }

    /**TODO: add cache segment/ add hiddeninindex filter */

    public const MAX_NAVIGATION_DEPTH = 2;

    /**
     * @return ComponentCollection<MainNavigationItem>|null
     */
    public function fromRootNode(NeosContext $context): ComponentCollection|null
    {
        $subtree = $context->subgraph->findSubtree(
            $context->siteNode->aggregateId,
            FindSubtreeFilter::create(
                "Vendor.WheelInventor:Tag.MainNavigationElement",
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
                $context->neos
            );
            if (!$item instanceof MainNavigationItem) {
                continue;
            }

            $childNavigationItems[] = $item;
        };

        return ComponentCollection::list(...$childNavigationItems);
    }

    private function createMainNavigationItemFromSubtree(
        Subtree $subtree,
        NeosAccessInterface $neos,
        int $level = 1
    ): MainNavigationItem|MainNavigationSubItem {
        $childNavigationItems = [];

        foreach ($subtree->children as $child) {
            $childNavigationItems[] = $this->createMainNavigationItemFromSubtree(
                $child,
                $neos,
                $level + 1
            );
        }

        $linkStruct = LinkStruct::create(
            href: (string)$neos->getNodeUri($subtree->node),
            title: null,
            rel: null,
            target: LinkTarget::TARGET_SELF
        );

        $itemsCollection = !empty($childNavigationItems)
            ? ComponentCollection::list(...$childNavigationItems)
            : null;

        if ($level === 1) {
            return MainNavigationItem::create(
                link: $linkStruct,
                label: $this->nodeLabelGenerator->getLabel($subtree->node),
                items: $itemsCollection
            );
        } else {
            return MainNavigationSubItem::create(
                link: $linkStruct,
                label: $this->nodeLabelGenerator->getLabel($subtree->node)
            );
        }
    }
}
