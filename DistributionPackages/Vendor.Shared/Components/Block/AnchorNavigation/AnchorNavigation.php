<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\AnchorNavigation;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AnchorNavigation implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $items,
        private bool $isSticky,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $items,
        bool $isSticky,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
            isSticky: $isSticky,
        );
    }

    public function render(): string
    {
        return ($this->isSticky ? '<section class="sticky top-header z-40 h-sticky-nav-height bg-brand-grey col-span-full grid grid-cols-subgrid"><sticky-navigation data-component="AnchorNavigation" data-sticky="true" class="' . _\Util::joinAttributeValues(['group col-span-content-full no-undefined-hide sticky-nav-active overflow-x-hidden flex gap-16 md:gap-24', '[--anchor-navigation-gap:var(--spacing-16)] md:[--anchor-navigation-gap:var(--spacing-24)]']) . '">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</sticky-navigation></section>' : '<div class="group col-span-full flex flex-wrap justify-center items-center divide-x divide-brand-grey">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div>');
    }
}
