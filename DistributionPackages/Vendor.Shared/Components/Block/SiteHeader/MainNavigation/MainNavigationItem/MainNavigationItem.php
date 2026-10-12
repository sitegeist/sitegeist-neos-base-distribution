<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationItem;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class MainNavigationItem implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $items,
        private Link $_16_24_Link,
        private Link $_37_28_Link,
        private Link $_51_18_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        string $label,
        ?string $ariaCurrent,
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
            _16_24_Link: Link::create(
                content: _\SlotComponent::list(
                    _\Util::escapeText($label),
                ),
                link: $link,
                component: null,
                ariaCurrent: $ariaCurrent,
                variant: LinkVariant::VARIANT_MENU_ITEM,
            ),
            _37_28_Link: Link::create(
                content: _\SlotComponent::list(
                    _\Util::escapeText($label),
                ),
                link: $link,
                component: null,
                ariaCurrent: $ariaCurrent,
                variant: LinkVariant::VARIANT_MENU_ITEM,
            ),
            _51_18_Link: Link::create(
                content: _\SlotComponent::list(
                    _\Util::escapeText($label),
                ),
                link: $link,
                component: null,
                ariaCurrent: $ariaCurrent,
                variant: LinkVariant::VARIANT_MENU_ITEM,
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<div data-component="MainNavigationItem" class="relative group/navItem">' . (($this->items !== null) ? '<div class="max-lg:hidden h-full">' . $this->_16_24_Link->render() . '<sl-menu class="' . _\Util::joinAttributeValues('pointer-events-none absolute top-full left-1/2 -translate-x-1/2 opacity-0', 'group-focus-within/navItem:opacity-100 group-hover/navItem:opacity-100', 'group-hover/navItem:pointer-events-auto transition-opacity', 'min-w-48 shadow-lg bg-white') . '">' . ((($temp = $this->items) === null) ? '' : $temp->render()) . '</sl-menu></div><div class="lg:hidden relative"><div class="absolute top-0 left-0 py-8">' . $this->_37_28_Link->render() . '</div><sl-details><div class="flex flex-col gap-16 py-16">' . ((($temp = $this->items) === null) ? '' : $temp->render()) . '</div></sl-details></div>' : $this->_51_18_Link->render()) . '</div>';
    }
}
