<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Figure;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Figure implements _\ComponentInterface
{
    private function __construct(
        private ?string $src,
        private ?string $alt,
        private ?string $title,
        private ?string $class,
    ) {
    }

    public static function create(
        ?string $src,
        ?string $alt,
        ?string $title,
        ?string $class,
    ): self {
        return new self(
            src: $src,
            alt: $alt,
            title: $title,
            class: $class,
        );
    }

    public function render(): string
    {
        return '<figure data-component="Figure" class="' . _\Util::joinAttributeValues(['[Block.Figure placeholder]', 'w-full h-full flex flex-col max-h-full relative', (($this->class !== null) ? (($temp = $this->class) === null ? '' : _\Util::escapeAttributeValue($temp)) : '')]) . '">' . (($this->src !== null) ? '<img' . (($temp = $this->src) === null ? '' : ' src="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($this->alt !== null) ? (($temp = $this->alt) === null ? '' : ' alt="' . _\Util::escapeAttributeValue($temp) . '"') : ' alt=""') . '' . (($temp = $this->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . ' class="w-full h-full object-cover" loading="lazy" />' : '<div class="w-full h-full min-h-64 flex items-center justify-center bg-brand-grey copy-small uppercase">No image</div>') . '</figure>';
    }
}
