<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\Grid;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Grid implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div>' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
