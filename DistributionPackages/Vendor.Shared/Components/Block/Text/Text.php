<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Text;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Text\TextColumns;
use Vendor\Shared\Components\Layout\Grid\ContentGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Text implements _\ComponentInterface
{
    private function __construct(
        private ContentGrid $_168_ContentGrid,
    ) {
    }

    public static function create(
        TextColumns $columns,
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $button,
    ): self {
        return new self(
            _168_ContentGrid: ContentGrid::create(
                content: _\SlotComponent::list(
                    '<div class="' . _\Util::joinAttributeValues('col-span-full', match ($columns) { TextColumns::COLUMNS_TWO_COLUMNS => 'sm:col-span-full lg:col-span-6', default => 'sm:col-span-full' }) . '">',
                    Headline::create(
                        content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                        variant: HeadlineVariant::VARIANT_REGULAR,
                        size: HeadlineSize::SIZE_LG,
                        tag: HeadlineTag::TAG_H2,
                    ),
                    '</div>',
                    '<div class="' . _\Util::joinAttributeValues('col-span-full flex flex-col gap-16 md:gap-24', match ($columns) { TextColumns::COLUMNS_TWO_COLUMNS => 'sm:col-span-full lg:col-span-6', default => 'sm:col-span-full' }) . '">',
                    Copy::create(
                        content: (is_string(($temp = $content)) ? _\StringComponent::fromString($temp) : $temp),
                        size: CopySize::SIZE_MD,
                    ),
                    (is_string(($temp = $button)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
                componentName: 'Text',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_168_ContentGrid->render();
    }
}
