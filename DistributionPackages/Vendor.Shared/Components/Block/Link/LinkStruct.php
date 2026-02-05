<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class LinkStruct
{
    private function __construct(
        public ?string $href,
        public ?string $title,
        public ?string $rel,
        public ?string $target,
    ) {
    }

    public static function create(
        ?string $href,
        ?string $title,
        ?string $rel,
        ?string $target,
    ): self {
        return new self(
            href: $href,
            title: $title,
            rel: $rel,
            target: $target,
        );
    }
}
