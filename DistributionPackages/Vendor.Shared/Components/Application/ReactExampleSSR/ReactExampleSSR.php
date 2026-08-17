<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Application\ReactExampleSSR;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ReactExampleSSR implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_138_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        string $appData,
        string $labels,
        _\ComponentInterface|string|null $renderedApplication,
    ): self {
        return new self(
            _138_ContentGrid: ContentGrid::create(
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        size: HeadlineSize::SIZE_LG,
                        tag: HeadlineTag::TAG_H2,
                    ),
                    '</div>',
                    '<div data-root data-app-data="' . _\Util::escapeAttributeValue($appData) . '" data-labels="' . _\Util::escapeAttributeValue($labels) . '" class="col-span-full">',
                    (is_string(($temp = $renderedApplication)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
                componentName: 'ReactExampleSSR',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_138_ContentGrid->render();
    }
}
