<?php

declare(strict_types=1);

namespace Vendor\Site\Integration;

use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\Link\LinkVariant;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigation;
use Vendor\Shared\Components\Block\SiteHeader\SiteHeader;
use Vendor\Site\NodeTypes\Document\Document;
use Vendor\Site\NodeTypes\Document\HomePage\HomePage;

final class SiteHeaderFactory
{
    public function __construct(
        private readonly MainNavigationItemFactory $mainNavigationItemFactory
    ) {
    }

    /**
     * @param NeosContext<Document,Document,HomePage> $context
     */
    public function forDocumentNode(
        NeosContext $context,
    ): SiteHeader {
        return SiteHeader::create(
            // @todo: link in der Komponente?
            homeLink: Link::create(
                content: "Home",
                link: LinkStruct::create(
                    href: (string)$context->neos->getNodeUri($context->site->node),
                    title: "Home",
                    rel: null,
                    target: LinkTarget::TARGET_SELF
                ),
                component: null,
                variant: LinkVariant::VARIANT_MENU_ITEM,
                ariaCurrent: null,
            ),
            mainNavigation: MainNavigation::create(
                items: $this->mainNavigationItemFactory->fromRootNode(
                    $context->site,
                    $context->documentNode,
                    $context->subgraph,
                    $context->neos
                )
            ),
        );
    }
}
