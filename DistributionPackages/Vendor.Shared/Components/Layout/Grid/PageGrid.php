<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\Grid;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class PageGrid implements _\ComponentInterface
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
        return '<div class="' . _\Util::joinAttributeValues(...['w-full h-full grid grid-cols-page-12', 'gap-x-16 md:gap-x-32 grow grid-rows-[auto_1fr_auto]']) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
