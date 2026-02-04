<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Icon;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Icon implements _\ComponentInterface
{
    private function __construct(
        private string $icon,
        private string $class,
    ) {
    }

    public static function create(
        string $icon,
        string $class,
    ): self {
        return new self(
            icon: $icon,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<div component="Icon" class="' . _\Util::escapeAttributeValue($this->class) . '">WIP: ' . _\Util::escapeRenderValue($this->icon) . '</div>';
    }
}
