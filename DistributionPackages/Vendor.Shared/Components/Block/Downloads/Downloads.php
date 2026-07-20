<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Downloads;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\ContentCollectionGrid;
use Vendor\Shared\Components\Layout\Grid\ContentCollectionGridVariant;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Downloads implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_148_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _148_ContentGrid: ContentGrid::create(
                componentName: 'Downloads',
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    '</div>',
                    ContentCollectionGrid::create(
                        variant: ContentCollectionGridVariant::VARIANT_FOUR_COLUMNS,
                        content: $content,
                    )
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_148_ContentGrid->render();
    }
}
