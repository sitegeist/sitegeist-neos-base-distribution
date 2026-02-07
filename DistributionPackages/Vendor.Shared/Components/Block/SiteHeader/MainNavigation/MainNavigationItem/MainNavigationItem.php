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
        private Link $_1824_Link,
        private Link $_4028_Link,
        private Link $_5716_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        string $label,
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
            _1824_Link: Link::create(
                link: $link,
                variant: LinkVariant::VARIANT_MENU_ITEM,
                component: null,
                content: _\SlotComponent::list(
                    _\Util::escapeRenderValue($label)
                ),
            ),
            _4028_Link: Link::create(
                link: $link,
                variant: LinkVariant::VARIANT_MENU_ITEM,
                component: null,
                content: _\SlotComponent::list(
                    _\Util::escapeRenderValue($label)
                ),
            ),
            _5716_Link: Link::create(
                link: $link,
                variant: LinkVariant::VARIANT_MENU_ITEM,
                component: null,
                content: _\SlotComponent::list(
                    _\Util::escapeRenderValue($label)
                ),
            ),
        );
    }

    public function render(): string
    {
        return '<div data-component="MainNavigationItem" class="relative group/navItem">' . (($this->items !== null) ? '<div class="max-lg:hidden h-full">' . $this->_1824_Link->render() . '<sl-menu class="' . _\Util::joinAttributeValues(['pointer-events-none absolute top-full left-1/2 -translate-x-1/2 opacity-0', 'group-focus-within/navItem:opacity-100 group-hover/navItem:opacity-100', 'group-hover/navItem:pointer-events-auto transition-opacity', 'min-w-48 shadow-lg bg-white']) . '">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</sl-menu></div><div class="lg:hidden relative"><div class="absolute top-0 left-0 py-8">' . $this->_4028_Link->render() . '</div><sl-details><div class="flex flex-col gap-16 py-16">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div></sl-details></div>' : $this->_5716_Link->render()) . '</div>';
    }
}
