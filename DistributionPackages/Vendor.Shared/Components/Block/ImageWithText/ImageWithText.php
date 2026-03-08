<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\ImageWithText;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextAlignment;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextLayout;
use Vendor\Shared\Components\Block\Link\LinkedButton;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ImageWithText implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_238_ContentGrid,
    ) {
    }

    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $figure
     * @param Button|LinkedButton|_\ComponentEnvelopeInterface<Button|LinkedButton>|_\ComponentInterface|null $button
     */
    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $figure,
        Button|LinkedButton|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $button,
        ImageWithTextAlignment $alignment,
        ImageWithTextLayout $layout,
    ): self {
        return new self(
            _238_ContentGrid: ContentGrid::create(
                componentName: 'ImageWithText',
                content: _\SlotComponent::list(
                    '<div class="col-span-full grid grid-cols-subgrid">',
                    '<div' .  (($temp = _\Util::joinAttributeValues([match ($alignment) { ImageWithTextAlignment::VARIANT_IMAGELAST => 'lg:order-2', default => 'lg:order-1' }, match ($layout) { ImageWithTextLayout::VARIANT_66_33 => 'lg:col-span-8', ImageWithTextLayout::VARIANT_33_66 => 'lg:col-span-4', default => 'lg:col-span-6' }])) === '' ? '' : ' class="' . $temp . '"') . '>',
                    (($temp = $figure) === null ? null : $temp),
                    '</div>',
                    '<div class="' . _\Util::joinAttributeValues(['flex flex-col gap-16 md:gap-24 justify-center', match ($alignment) { ImageWithTextAlignment::VARIANT_IMAGELAST => 'lg:order-1', default => 'lg:order-2' }, match ($layout) { ImageWithTextLayout::VARIANT_66_33 => 'lg:col-span-4', ImageWithTextLayout::VARIANT_33_66 => 'lg:col-span-8', default => 'lg:col-span-6' }]) . '">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    Copy::create(
                        size: CopySize::SIZE_MD,
                        content: $content,
                    ),
                    (($temp = $button) === null ? null : $temp),
                    '</div>',
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_238_ContentGrid->render();
    }
}
