<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\SiteFooter\SiteFooter;

final class SiteFooterFactory
{
    public function forDocumentNode(
        NeosContext $context
    ): SiteFooter {
        return SiteFooter::create();
    }
}
