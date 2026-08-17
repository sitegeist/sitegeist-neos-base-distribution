<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\PageGridWithContentContainer;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Components\Layout\Grid\PageGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class PageGridWithContentContainer implements _\ComponentInterface
{
    private function __construct(
        private PageGrid $_98_PageGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _98_PageGrid: PageGrid::create(
                content: _\SlotComponent::list(
                    ContentContainer::create(
                        tagName: ContentContainerTag::TAG_SECTION,
                        variant: ContentContainerVariant::VARIANT_REGULAR,
                        content: _\SlotComponent::list(
                            (is_string(($temp = $content)) ? _\Util::escapeText($temp) : $temp),
                        ),
                        anchorId: '',
                    ),
                ),
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_98_PageGrid->render();
    }
}
