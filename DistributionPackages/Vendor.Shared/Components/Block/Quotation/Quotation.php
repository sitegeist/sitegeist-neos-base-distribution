<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Quotation;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Quotation implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_138_ContentGrid,
    ) {
    }

    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $figure
     */
    public static function create(
        Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $figure,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $spokenByName,
        _\ComponentInterface|string|null $spokenByJobTitle,
    ): self {
        return new self(
            _138_ContentGrid: ContentGrid::create(
                componentName: 'Quotation',
                content: _\SlotComponent::list(
                    '<div class="col-span-full sm:col-span-4">',
                    '<div class="w-full aspect-square rounded-full overflow-hidden">',
                    (($temp = $figure) === null ? null : $temp),
                    '</div>',
                    '</div>',
                    '<div class="col-span-full sm:col-span-8 md:col-start-6 flex flex-col gap-16 md:gap-24 justify-center">',
                    '<div class="relative flex flex-col gap-8 pt-40">',
                    '<span class="absolute top-0 left-0 md:-left-24 text-[100px] leading-[0.7] pointer-events-none z-0">',
                    '"',
                    '</span>',
                    Copy::create(
                        size: CopySize::SIZE_MD,
                        content: $content,
                    ),
                    '</div>',
                    '<div class="flex flex-col">',
                    '<span class="copy-medium font-bold">',
                    (($temp = $spokenByName) === null ? null : $temp),
                    '</span>',
                    '<span class="copy-small">',
                    (($temp = $spokenByJobTitle) === null ? null : $temp),
                    '</span>',
                    '</div>',
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_138_ContentGrid->render();
    }
}
