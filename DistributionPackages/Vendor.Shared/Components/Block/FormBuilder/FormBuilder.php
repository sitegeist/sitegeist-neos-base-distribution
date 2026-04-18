<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class FormBuilder implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_128_ContentGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _128_ContentGrid: ContentGrid::create(
                componentName: 'FormBuilder',
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    '</div>',
                    '<div class="col-span-full" data-form-wrapper>',
                    (($temp = $content) === null ? null : $temp),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_128_ContentGrid->render();
    }
}
