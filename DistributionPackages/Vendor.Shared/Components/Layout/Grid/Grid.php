<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\Grid;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Grid implements _\ComponentInterface
{
    private function __construct(
        private ?string $component,
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        ?string $component,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            component: $component,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div' . (($temp = $this->component) === null ? '' : ' data-component="' . _\Util::escapeAttributeValue($temp) . '"') . ' class="' . _\Util::joinAttributeValues(['grid grid-cols-4 sm:grid-cols-8 lg:grid-cols-12', 'gap-x-16 md:gap-x-32', 'gap-y-16 md:gap-y-32']) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
