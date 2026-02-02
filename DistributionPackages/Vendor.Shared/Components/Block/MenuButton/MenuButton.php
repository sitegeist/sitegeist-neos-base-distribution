<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\MenuButton;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class MenuButton implements _\ComponentInterface
{
    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function render(): string
    {
        return '<button class="relative flex h-8 w-8 items-center justify-center shrink-0 cursor-pointer" data-menu-button><span class="relative block h-[80%] w-full"><span class="' . _\Util::joinAttributeValues(['absolute block bg-cta-contrast w-full origin-center transition-all duration-500 h-1 top-0', 'group-data-open/SiteHeader:top-1/2 group-data-open/SiteHeader:-translate-y-1/2', 'group-data-open/SiteHeader:rotate-45']) . '"></span><span class="' . _\Util::joinAttributeValues(['absolute block bg-cta-contrast w-full h-1 top-1/2', 'origin-center transition-all duration-500 -translate-y-1/2', 'group-data-open/SiteHeader:scale-x-0']) . '"></span><span class="' . _\Util::joinAttributeValues(['absolute block bg-cta-contrast w-full  h-1 top-full', 'origin-center transition-all duration-500 -translate-y-full', 'group-data-open/SiteHeader:top-1/2 group-data-open/SiteHeader:-translate-y-1/2', 'group-data-open/SiteHeader:-rotate-45']) . '"></span></span></button>';
    }
}
