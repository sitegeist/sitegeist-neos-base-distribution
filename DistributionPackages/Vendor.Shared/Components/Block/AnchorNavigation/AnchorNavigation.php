<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\AnchorNavigation;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AnchorNavigation implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $items,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $items,
    ): self {
        return new self(
            items: is_string($items) ? _\StringComponent::fromString($items) : $items,
        );
    }

    public function render(): string
    {
        return '<div data-component="AnchorNavigation" class="col-span-full flex flex-wrap justify-center items-center divide-x divide-brand-grey">' . (($temp = $this->items) === null ? '' : $temp->render()) . '</div>';
    }
}
