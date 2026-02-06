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

final class MainNavigationItemFactory
{
    public function __construct(
        private readonly NodeLabelGeneratorInterface $nodeLabelGenerator
    ) {
    }

    /**TODO: add cache segment/ add hiddeninindex filter */

    public const MAX_NAVIGATION_DEPTH = 2;

    /*
     * @return ComponentCollection<MainNavigationItem>
    */
    public function fromRootNode(NeosContext $context): ComponentCollection|null
    {
        $childNavigationItems = [];

        $subtree = $context->subgraph->findSubtree(
            $context->siteNode->aggregateId,
            FindSubtreeFilter::create(
                "Vendor.WheelInventor:Tag.MainNavigationElement",
                self::MAX_NAVIGATION_DEPTH
            )
        );

        foreach ($subtree->children as $child) {
            $childNavigationItems[] = $this->createMainNavigationITemFromSubtree(
                $child,
                $context->neos
            );
        };

        return ComponentCollection::list(...$childNavigationItems);
    }

    private function createMainNavigationITemFromSubtree(
        Subtree $subtree,
        NeosAccessInterface $neos
    ): MainNavigationItem {
        $childNavigationItems = [];

        foreach ($subtree->children as $child) {
            $childNavigationItems[] = $this->createMainNavigationITemFromSubtree(
                $child,
                $neos
            );
        };

        /**TODO: add function to linkstructfactory */
        return MainNavigationItem::create(
            link: LinkStruct::create(
                href: (string)$neos->getNodeUri($subtree->node),
                title: null,
                rel: null,
                target: LinkTarget::TARGET_SELF
            ),
            label: $this->nodeLabelGenerator->getLabel($subtree->node),
            items: ComponentCollection::list(...$childNavigationItems)
        );
    }
}