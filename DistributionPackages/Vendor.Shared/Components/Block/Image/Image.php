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
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        size: HeadlineSize::SIZE_LG,
                        tag: HeadlineTag::TAG_H2,
                    ),
                    '</div>',
                    '<div class="col-span-full">',
                    (is_string(($temp = $figure)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
                componentName: 'Image',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_118_ContentGrid->render();
    }
}
