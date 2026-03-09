<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\AnchorNavigation;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AnchorNavigationItem implements _\ComponentInterface
{
    private function __construct(
        private Link $_118_Link,
    ) {
    }

    public static function create(
        LinkStruct $link,
        _\ComponentInterface|string|null $title,
        bool $inBackend,
    ): self {
        return new self(
            _118_Link: Link::create(
                component: 'AnchorNavigationItem',
                link: $link,
                variant: LinkVariant::VARIANT_DEFAULT,
                inBackend: $inBackend,
                content: _\SlotComponent::list(
                    '<span class="px-24 py-16">',
                    (($temp = $title) === null ? null : $temp),
                    '</span>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_118_Link->render();
    }
}
