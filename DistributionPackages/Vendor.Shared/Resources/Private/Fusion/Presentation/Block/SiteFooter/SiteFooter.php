<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\SiteFooter;

use GuzzleHttp\Psr7\Uri;
use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use Vendor\Shared\Presentation\Block\Link\Links;

#[Flow\Proxy(false)]
final readonly class SiteFooter extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly string $primaryMenuTitle,
        public readonly ?Links $primaryNavigationItems,
        public readonly string $secondaryMenuTitle,
        public readonly ?Links $secondaryNavigationItems,
        public readonly string $thirdMenuTitle,
        public readonly ?Links $thirdNavigationItems,
        public readonly ?Uri $facebookUri,
        public readonly ?Uri $instagramUri,
        public readonly ?Uri $xingUri,
        public readonly ?Uri $xUri,
        public readonly ?Uri $linkedinUri,
    ) {
    }
}
