<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Icon;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Icon implements _\ComponentInterface
{
    private function __construct(
        private string $icon,
        private ?string $class,
    ) {
    }

    public static function create(
        string $icon,
        ?string $class,
    ): self {
        return new self(
            icon: $icon,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" component="Icon" class="' . _\Util::joinAttributeValues(['fill-current', (($temp = $this->class) === null ? '' : _\Util::escapeAttributeValue($temp))]) . '" height="1em" width="1em"><use xlink:href="' . '/stampede/svgsprite?collection=shared#' . _\Util::escapeAttributeValue($this->icon) . '" href="' . '/stampede/svgsprite?collection=shared#' . _\Util::escapeAttributeValue($this->icon) . '" /></svg>';
    }
}
