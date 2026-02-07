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
        private Link $_1512_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        string $label,
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
            _1512_Link: Link::create(
                link: $link,
                variant: LinkVariant::VARIANT_MENU,
                component: null,
                content: _\SlotComponent::list(
                    _\Util::escapeRenderValue($label)
                ),
            ),
        );
    }

    public function render(): string
    {
        return '<div data-component="MainNavigationItem" class="relative lg:[&amp;&gt;a]:flex lg:[&amp;&gt;a]:items-center lg:[&amp;&gt;a]:h-full group/navItem">' . $this->_1512_Link->render() . '' . (($this->items !== null) ? '<div class="' . _\Util::joinAttributeValues(['max-lg:hidden pointer-events-none absolute top-full left-1/2 -translate-x-1/2 opacity-0', 'group-focus-within/navItem:opacity-100 group-hover/navItem:opacity-100', 'group-hover/navItem:pointer-events-auto transition-opacity']) . '"><sl-menu class="min-w-48 shadow-lg bg-white">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</sl-menu></div>' : '') . '' . (($this->items !== null) ? '<div class="lg:hidden pt-16 flex flex-col gap-8">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div>' : '') . '</div>';
    }
}
