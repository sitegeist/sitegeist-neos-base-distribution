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
        return '<button class="relative z-30 flex h-24 w-24 items-center justify-center shrink-0 cursor-pointer lg:hidden" data-menu-button aria-label="Toggle menu"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6" class="' . "\n" . '                        transition-all duration-500' . "\n" . '                        origin-center' . "\n" . '                        group-data-open/SiteHeader:translate-y-[6px]' . "\n" . '                        group-data-open/SiteHeader:rotate-45' . "\n" . '                    " style="transform-box: fill-box;" /><line x1="3" y1="12" x2="21" y2="12" class="' . "\n" . '                        transition-all duration-500' . "\n" . '                        origin-center' . "\n" . '                        group-data-open/SiteHeader:opacity-0' . "\n" . '                    " style="transform-box: fill-box;" /><line x1="3" y1="18" x2="21" y2="18" class="' . "\n" . '                        transition-all duration-500' . "\n" . '                        origin-center' . "\n" . '                        group-data-open/SiteHeader:-translate-y-[6px]' . "\n" . '                        group-data-open/SiteHeader:-rotate-45' . "\n" . '                    " style="transform-box: fill-box;" /></svg></button>';
    }
}
