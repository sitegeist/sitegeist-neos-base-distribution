<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Copy;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Copy\CopySize;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Copy implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private CopySize $size,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        CopySize $size,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            size: $size,
        );
    }

    public function render(): string
    {
        return '<div data-component="Copy" class="' . _\Util::joinAttributeValues(['prose', match ($this->size) { CopySize::SIZE_SM => 'copy-small', CopySize::SIZE_MD => 'copy-medium', CopySize::SIZE_LG => 'copy-large' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
