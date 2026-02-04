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

    public function render(): string
    {
        return '<' . ($_129_tag = $this->tag->value) . '' .  (($temp = _\Util::joinAttributeValues(['[Block.Headline (' . _\Util::escapeAttributeValue($this->variant->value) . ', ' . _\Util::escapeAttributeValue($this->size->value) . ')] w-full', match ($this->size) { HeadlineSize::SIZE_SM => 'head-h4 lg:head-hl5', HeadlineSize::SIZE_MD => 'head-hl6 sm:head-hl3 lg:head-hl4 xl:head-hl5', HeadlineSize::SIZE_LG => 'head-hl6 sm:head-hl5 lg:head-hl5 xl:head-hl4', HeadlineSize::SIZE_XL => 'head-hl5 sm:head-hl3 lg:head-hl2 xl:head-hl1', default => '' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '>' . (($temp = $this->content) === null ? '' : $temp->render()) . '</' . $_129_tag . '>';
    }
}
