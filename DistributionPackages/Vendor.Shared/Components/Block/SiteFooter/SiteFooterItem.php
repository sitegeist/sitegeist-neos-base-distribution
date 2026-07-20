<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteFooter;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class SiteFooterItem implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $title,
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $title,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            title: is_string($title) ? _\StringComponent::fromString($title) : $title,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div class="text-center lg:text-left flex flex-col gap-24">' . (($this->title !== null) ? '<div class="text-center lg:text-left font-bold">' . (($temp = $this->title) === null ? '' : $temp->render()) . '</div>' : '') . '' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
