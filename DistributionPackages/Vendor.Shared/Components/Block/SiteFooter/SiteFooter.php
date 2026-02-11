<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteFooter;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class SiteFooter implements _\ComponentInterface
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
        return '<footer data-component="SiteFooter" class="' . _\Util::joinAttributeValues(['group/SiteFooter col-span-full mt-auto', 'grid grid-cols-subgrid bg-brand-grey h-[100px]']) . '"><div class="col-span-content-full h-full flex justify-between w-full items-center">Footer</div></footer>';
    }
}
