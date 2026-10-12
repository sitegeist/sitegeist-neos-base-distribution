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

    #[\Override]
    public function render(): string
    {
        return '<div class="' . _\Util::joinAttributeValues('w-full h-full grid grid-cols-page-4 md:grid-cols-page-8 xl:grid-cols-page-12', 'gap-x-24 md:gap-x-32 lg:gap-x-56 xl:gap-x-64 grow grid-rows-[auto_1fr_auto]') . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</div>';
    }
}
