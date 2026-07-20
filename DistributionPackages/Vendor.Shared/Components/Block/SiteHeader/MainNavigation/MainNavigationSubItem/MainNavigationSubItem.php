<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigationSubItem;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class MainNavigationSubItem implements _\ComponentInterface
{
    private function __construct(
        private Link $_98_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        string $label,
    ): self {
        return new self(
            _98_Link: Link::create(
                link: $link,
                variant: LinkVariant::VARIANT_MENU_SUB_ITEM,
                component: null,
                inBackend: false,
                content: _\SlotComponent::list(
                    '<sl-menu-item class="max-lg:hidden">',
                    _\Util::escapeRenderValue($label),
                    '</sl-menu-item>',
                    '<span class="lg:hidden">',
                    _\Util::escapeRenderValue($label),
                    '</span>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_98_Link->render();
    }
}
