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
        private Link $_1616_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        string $label,
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
            _1616_Link: Link::create(
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
        return '<div data-component="MainNavigationItem" class="group/MainNavigationItem block relative lg:flex lg:items-center"><div class="flex items-center justify-between">' . $this->_1616_Link->render() . '<button class="lg:hidden relative w-8 h-8 flex items-center justify-center cursor-pointer" aria-expanded="false" data-toggle-submenu><span class="absolute block w-4 h-0.5 bg-current top-1/2 origin-center rotate-0 transition-transform duration-300 group-data-open/MainNavigationItem:-rotate-90 group-data-open/MainNavigationItem:scale-x-0"></span><span class="absolute block w-4 h-0.5 bg-current top-1/2 origin-center rotate-90 transition-transform duration-300 group-data-open/MainNavigationItem:rotate-0"></span></button></div><div class="hidden lg:group-hover/MainNavigationItem:block absolute top-full"><div class="py-2 bg-white shadow-lg w-48">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div></div><div class="' . _\Util::joinAttributeValues(['lg:hidden overflow-hidden', 'transition-all duration-300', 'group-not-data-open/MainNavigationItem:!h-0']) . '" data-submenu><div class="mt-4 bg-gray-100">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div></div></div>';
    }
}
