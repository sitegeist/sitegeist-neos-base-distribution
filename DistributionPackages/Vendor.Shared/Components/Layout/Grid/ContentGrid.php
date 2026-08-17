<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\Grid;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ContentGrid implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private string $componentName,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        string $componentName,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            componentName: $componentName,
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<div data-component="' . _\Util::escapeAttributeValue($this->componentName) . '" class="' . _\Util::joinAttributeValues('col-span-full grid grid-cols-subgrid', 'gap-y-16 md:gap-y-32') . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</div>';
    }
}
