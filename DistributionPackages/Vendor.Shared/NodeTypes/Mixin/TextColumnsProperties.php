<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Vendor\Shared\Components\Block\Text\TextColumns;

/**
 * Backing trait for {@see TextColumnsMixin}
 */
trait TextColumnsProperties
{
    public function __construct(
        public readonly TextColumns $columns = TextColumns::COLUMNS_TWO_COLUMNS,
    ) {
    }
}
