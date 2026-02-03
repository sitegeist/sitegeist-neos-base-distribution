<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Text;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Text\TextColumns;
use Vendor\Shared\Components\Layout\Grid\Grid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Text implements _\ComponentInterface
{
    private function __construct(
        private Grid $_98_Grid,
    ) {
    }

    public static function create(
        TextColumns $columns,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _98_Grid: Grid::create(
                content: _\SlotComponent::list(
                    '<div data-component="Text" class="' . _\Util::joinAttributeValues(['[Block.Text (' . _\Util::escapeAttributeValue($columns->value) . ')]', 'col-span-full', match ($columns) { TextColumns::COLUMNS_TWO_COLUMNS => 'sm:columns-2', default => '' }]) . '">',
                    (($temp = $content) === null ? null : $temp),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return $this->_98_Grid->render();
    }
}
