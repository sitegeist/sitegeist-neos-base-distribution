<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;
use Vendor\Shared\Presentation\Block\MainNavigation\MainNavigation;
use Vendor\Shared\Presentation\Block\SiteHeader\SiteHeader;

final class SiteHeaderFactory
{
    public function __construct(
        private readonly NavigationItemFactory $navigationItemFactory
    ) {
    }

    public function forDocumentNode(
        Node $documentNode,
        Node $site,
        bool $inBackend
    ): SiteHeader {
        return new SiteHeader(
            homeLink: new Link(
                LinkVariant::VARIANT_REGULAR,
                ArchaeopteryxLink::create(
                    $this->uriService->getNodeUri($site),
                    $site->getProperty('title'),
                    LinkTarget::TARGET_SELF->value,
                    ['noopener', 'nofollow'],
                ),
                Value::fromString('Home'),
                $inBackend
            ),
            mainNavigation: new MainNavigation(
                items: $this->navigationItemFactory->forNavigationNode(
                    $site,
                    $documentNode,
                    1
                ) ?? null
            ),
        );
    }
}
