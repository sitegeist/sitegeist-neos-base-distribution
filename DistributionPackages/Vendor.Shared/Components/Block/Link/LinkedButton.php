<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class LinkedButton implements _\ComponentInterface
{
    private function __construct(
        private Link $_118_Link,
    ) {
    }

    /**
     * @param Button|_\ComponentEnvelopeInterface<Button> $button
     */
    public static function create(
        Button|_\ComponentEnvelopeInterface $button,
        LinkStruct $link,
    ): self {
        return new self(
            _118_Link: Link::create(
                link: $link,
                component: 'LinkedButton',
                variant: LinkVariant::VARIANT_NONE,
                inBackend: false,
                content: _\SlotComponent::list(
                    $button
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_118_Link->render();
    }
}
