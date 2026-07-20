<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Image;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Image implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_118_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $figure,
    ): self {
        return new self(
            _118_ContentGrid: ContentGrid::create(
                componentName: 'Image',
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    '</div>',
                    '<div class="col-span-full">',
                    (($temp = $figure) === null ? null : $temp),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_118_ContentGrid->render();
    }
}
