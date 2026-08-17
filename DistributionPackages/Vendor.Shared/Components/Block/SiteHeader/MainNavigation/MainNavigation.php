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

    #[\Override]
    public function render(): string
    {
        return '<nav data-component="MainNavigation" class="h-full z-20"><sl-drawer placement="end" class="lg:hidden" data-offcanvas-menu no-header><div class="overflow-y-auto max-h-full overflow-x-hidden pt-header px-16"><div class="flex flex-col gap-8">' . ((($temp = $this->items) === null) ? '' : $temp->render()) . '</div></div></sl-drawer><div class="hidden lg:flex h-full list-none gap-24">' . ((($temp = $this->items) === null) ? '' : $temp->render()) . '</div></nav>';
    }
}
