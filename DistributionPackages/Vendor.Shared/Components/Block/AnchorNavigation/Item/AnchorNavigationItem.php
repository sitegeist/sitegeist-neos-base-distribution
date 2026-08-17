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
        private Link $_98_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        _\ComponentInterface|string|null $title,
    ): self {
        return new self(
            _98_Link: Link::create(
                content: _\SlotComponent::list(
                    '<span class="whitespace-nowrap px-24 py-16 group-data-[sticky=true]:px-0 group-data-[sticky=true]:py-16 group-data-[sticky=true]:pr-8 group-data-[sticky=true]:last:pr-0">',
                    (is_string(($temp = $title)) ? _\Util::escapeText($temp) : $temp),
                    '</span>',
                ),
                link: $link,
                component: 'AnchorNavigationItem',
                variant: LinkVariant::VARIANT_DEFAULT,
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_98_Link->render();
    }
}
