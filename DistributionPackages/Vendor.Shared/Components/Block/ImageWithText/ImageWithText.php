<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\ImageWithText;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextAlignment;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextLayout;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ImageWithText implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_198_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $figure,
        _\ComponentInterface|string|null $button,
        ImageWithTextAlignment $alignment,
        ImageWithTextLayout $layout,
    ): self {
        return new self(
            _198_ContentGrid: ContentGrid::create(
                content: _\SlotComponent::list(
                    '<div' . ((($temp = _\Util::joinAttributeValues(match ($alignment) { ImageWithTextAlignment::VARIANT_IMAGELAST => 'lg:order-2', default => 'lg:order-1' }, match ($layout) { ImageWithTextLayout::VARIANT_66_33 => 'col-span-full md:col-span-8', ImageWithTextLayout::VARIANT_33_66 => 'col-span-full md:col-span-4', default => 'col-span-full md:col-span-6' })) === '') ? '' : ' class="' . $temp . '"') . '>',
                    (is_string(($temp = $figure)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                    '<div class="' . _\Util::joinAttributeValues('flex flex-col gap-16 md:gap-24 justify-center', match ($alignment) { ImageWithTextAlignment::VARIANT_IMAGELAST => 'lg:order-1', default => 'lg:order-2' }, match ($layout) { ImageWithTextLayout::VARIANT_66_33 => 'col-span-full md:col-span-4', ImageWithTextLayout::VARIANT_33_66 => 'col-span-full md:col-span-8', default => 'col-span-full md:col-span-6' }) . '">',
                    Headline::create(
                        content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        size: HeadlineSize::SIZE_LG,
                        tag: HeadlineTag::TAG_H2,
                    ),
                    Copy::create(
                        content: (is_string(($temp = $content)) ? _\StringComponent::fromString($temp) : $temp),
                        size: CopySize::SIZE_MD,
                    ),
                    (is_string(($temp = $button)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
                componentName: 'ImageWithText',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_198_ContentGrid->render();
    }
}
