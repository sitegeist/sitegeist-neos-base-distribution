<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Text;

enum TextColumns : string
{
    case COLUMNS_ONE_COLUMN = 'Eine Spalte';
    case COLUMNS_TWO_COLUMNS = 'Zwei Spalten';

    public function asString(): string
    {
        return $this->value;
    }

    public function asText(): string
    {
        return $this->value;
    }

    public function asAttributeValue(): string
    {
        return $this->value;
    }
}
