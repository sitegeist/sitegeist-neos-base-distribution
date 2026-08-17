<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\LinkedButton;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class LinkedButton implements _\ComponentInterface
{
    private function __construct(
        private Link $_108_Link,
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
            _108_Link: Link::create(
                link: $link,
                component: 'LinkedButton',
                variant: LinkVariant::VARIANT_NONE,
                content: _\SlotComponent::list(
                    $button
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_108_Link->render();
    }
}
