<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\AtomContainer;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Layout\Grid\PageGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AtomContainer implements _\ComponentInterface
{
    private function __construct(
        private PageGrid $_68_PageGrid,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _68_PageGrid: PageGrid::create(
                content: _\SlotComponent::list(
                    '<div data-component="AtomContainer" class="col-span-content-full py-32">',
                    (($temp = $content) === null ? null : $temp),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_68_PageGrid->render();
    }
}
