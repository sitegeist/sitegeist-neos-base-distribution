<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteHeader\MainNavigation;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class MainNavigation implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $items,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
        );
    }

    public function render(): string
    {
        return '<nav data-component="MainNavigation" class="h-full z-20"><div class="contents lg:block h-full"><div class="' . _\Util::joinAttributeValues(['lg:contents', 'absolute top-0 right-0 h-dvh w-0 max-w-dvw pt-header bg-white', 'transition-all duration-500 ease-in-out', 'group-data-open/SiteHeader:w-full md:group-data-open/SiteHeader:w-80']) . '" data-offcanvas-menu><div class="lg:contents overflow-y-auto max-h-full overflow-x-hidden"><div class="' . _\Util::joinAttributeValues(['list-none p-10 w-dvw flex flex-col gap-24', 'md:w-80 lg:flex-row lg:p-0 lg:h-full lg:w-full']) . '">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div></div></div></div></nav>';
    }
}
