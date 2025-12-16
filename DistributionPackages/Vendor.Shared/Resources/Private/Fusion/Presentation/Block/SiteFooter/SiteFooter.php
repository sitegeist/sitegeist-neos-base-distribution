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
        public string $primaryMenuTitle,
        public ?Links $primaryNavigationItems,
        public string $secondaryMenuTitle,
        public ?Links $secondaryNavigationItems,
        public string $thirdMenuTitle,
        public ?Links $thirdNavigationItems,
        public ?Uri $facebookUri,
        public ?Uri $instagramUri,
        public ?Uri $xingUri,
        public ?Uri $xUri,
        public ?Uri $linkedinUri,
    ) {
    }
}
