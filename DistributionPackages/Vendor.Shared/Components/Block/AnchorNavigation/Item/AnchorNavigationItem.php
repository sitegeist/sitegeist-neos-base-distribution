<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\AnchorNavigation\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AnchorNavigationItem implements _\ComponentInterface
{
    private function __construct(
        private Link $_128_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        _\ComponentInterface|string|null $title,
        bool $inBackend,
        bool $forSticky,
    ): self {
        return new self(
            _128_Link: Link::create(
                component: 'AnchorNavigationItem',
                link: $link,
                variant: LinkVariant::VARIANT_DEFAULT,
                inBackend: $inBackend,
                content: _\SlotComponent::list(
                    '<span class="' . _\Util::joinAttributeValues(['whitespace-nowrap', ($forSticky ? 'py-16 pr-8 last:pr-0' : 'px-24 py-16')]) . '">',
                    (($temp = $title) === null ? null : $temp),
                    '</span>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_128_Link->render();
    }
}
