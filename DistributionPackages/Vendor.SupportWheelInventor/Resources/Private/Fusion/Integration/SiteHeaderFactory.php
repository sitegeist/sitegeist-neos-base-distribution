<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use Vendor\Shared\Presentation\Block\SiteHeader\SiteHeader;

final class SiteHeaderFactory extends AbstractComponentPresentationObjectFactory
{
    public function forDocumentNode(
        Node $documentNode,
        Node $site
    ): SiteHeader {
        return new SiteHeader();
    }
}
