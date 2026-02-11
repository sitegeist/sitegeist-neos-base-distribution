<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Downloads\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Link\LinkedButton;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class DownloadsItem implements _\ComponentInterface
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
        return '<div data-component="DownloadsItem" class="p-16 flex flex-col justify-between h-full gap-16 bg-brand-grey"><div class="flex gap-16 h-full"><div class="w-1/4 flex items-start shrink-0 h-full"><div class="shadow-md h-full w-full">media</div></div><div class="flex flex-col justify-between h-full w-full"><div class="h-full flex flex-col justify-between mb-2"><div class="line-clamp-2">headline</div><div class="flex justify-between -mb-4"><div>primary meta headline</div><div>secondary meta headline</div></div></div></div></div></div>';
    }
}
