<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Headline;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Headline implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private HeadlineVariant $variant,
        private HeadlineSize $size,
        private HeadlineTag $tag,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        HeadlineVariant $variant,
        HeadlineSize $size,
        HeadlineTag $tag,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            variant: $variant,
            size: $size,
            tag: $tag,
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<' . ($_119_tag = $this->tag->asString()) . ' data-component="Headline" class="' . _\Util::joinAttributeValues('w-full', match ($this->size) { HeadlineSize::SIZE_SM => 'head-hl6', HeadlineSize::SIZE_MD => 'head-hl6 xl:head-hl5', HeadlineSize::SIZE_LG => 'head-hl5 md:head-hl5 xl:head-hl4', HeadlineSize::SIZE_XL => 'head-hl5 md:head-hl2 xl:head-hl1' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }) . '">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . '</' . $_119_tag . '>';
    }
}
