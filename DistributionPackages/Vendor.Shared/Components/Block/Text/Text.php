<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Text;

use PackageFactory\PHPComponentEngine as _;
use Vendor\Shared\Components\Block\Text\TextColumns;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Text implements _\ComponentInterface
{
    private function __construct(
        private TextColumns $columns,
        private _\ComponentInterface $content,
    ) {
    }

    public static function create(
        TextColumns $columns,
        _\ComponentInterface|string $content,
    ): self {
        return new self(
            columns: $columns,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div' .  (($temp = _\Util::joinAttributeValues(['[Block.Text (' . _\Util::escapeAttributeValue($this->columns->value) . ')]', match ($this->columns) { TextColumns::COLUMNS_TWO_COLUMNS => 'sm:columns-2', default => '' }])) === '' ? '' : ' class="' . $temp . '"') . '><div>' . $this->content->render() . '</div></div>';
    }
}
