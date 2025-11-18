<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Headline;

use PackageFactory\PHPComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Headline implements _\ComponentInterface
{
    private function __construct(
        private _\ComponentInterface $content,
        private HeadlineVariant $variant,
        private HeadlineSize $size,
        private HeadlineTag $tag,
    ) {
    }

    public static function create(
        _\ComponentInterface|string $content,
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
        return match ($this->tag) { HeadlineTag::TAG_H1 => '<h1' .  (($temp = _\Util::joinAttributeValues(['[Block.Headline (' . _\Util::escapeAttributeValue($this->variant->value) . ', ' . _\Util::escapeAttributeValue($this->size->value) . ')] w-full', match ($this->size) { HeadlineSize::SIZE_MD => 'text-md font-bold', HeadlineSize::SIZE_XL => 'text-xl font-bold', HeadlineSize::SIZE_2XL => 'text-2xl font-bold', default => '' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '>' . $this->content->render() . '</h1>', HeadlineTag::TAG_H2 => '<h2' .  (($temp = _\Util::joinAttributeValues(['[Block.Headline (' . _\Util::escapeAttributeValue($this->variant->value) . ', ' . _\Util::escapeAttributeValue($this->size->value) . ')] w-full', match ($this->size) { HeadlineSize::SIZE_MD => 'text-md font-bold', HeadlineSize::SIZE_XL => 'text-xl font-bold', HeadlineSize::SIZE_2XL => 'text-2xl font-bold', default => '' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '>' . $this->content->render() . '</h2>', HeadlineTag::TAG_H3 => '<h3' .  (($temp = _\Util::joinAttributeValues(['[Block.Headline (' . _\Util::escapeAttributeValue($this->variant->value) . ', ' . _\Util::escapeAttributeValue($this->size->value) . ')] w-full', match ($this->size) { HeadlineSize::SIZE_MD => 'text-md font-bold', HeadlineSize::SIZE_XL => 'text-xl font-bold', HeadlineSize::SIZE_2XL => 'text-2xl font-bold', default => '' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '>' . $this->content->render() . '</h3>', HeadlineTag::TAG_DIV => '<div' .  (($temp = _\Util::joinAttributeValues(['[Block.Headline (' . _\Util::escapeAttributeValue($this->variant->value) . ', ' . _\Util::escapeAttributeValue($this->size->value) . ')] w-full', match ($this->size) { HeadlineSize::SIZE_MD => 'text-md font-bold', HeadlineSize::SIZE_XL => 'text-xl font-bold', HeadlineSize::SIZE_2XL => 'text-2xl font-bold', default => '' }, match ($this->variant) { HeadlineVariant::VARIANT_UPPERCASE => 'uppercase', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '>' . $this->content->render() . '</div>' };
    }
}
