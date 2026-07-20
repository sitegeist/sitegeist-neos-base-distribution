<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Application\ReactExample;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ReactExample implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_138_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        string $appData,
        string $labels,
    ): self {
        return new self(
            _138_ContentGrid: ContentGrid::create(
                componentName: 'ReactExample',
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    '</div>',
                    '<div data-root data-app-data="' . _\Util::escapeAttributeValue($appData) . '" data-labels="' . _\Util::escapeAttributeValue($labels) . '" class="col-span-full"></div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_138_ContentGrid->render();
    }
}
