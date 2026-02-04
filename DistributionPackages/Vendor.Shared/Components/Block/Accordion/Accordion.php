<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Accordion;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Layout\Grid\Grid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Accordion implements _\ComponentInterface
{
    private function __construct(
        private Grid $_128_Grid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _128_Grid: Grid::create(
                component: 'Accordion',
                content: _\SlotComponent::list(
                    '<div class="col-span-full">',
                    Headline::create(
                        tag: HeadlineTag::TAG_H2,
                        size: HeadlineSize::SIZE_LG,
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        content: $headline,
                    ),
                    '</div>',
                    '<div data-__neos-insertion-anchor class="col-span-full">',
                    (($temp = $content) === null ? null : $temp),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_128_Grid->render();
    }
}
