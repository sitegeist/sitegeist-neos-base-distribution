<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

enum LinkTarget : string
{
    case TARGET_BLANK = '_blank';
    case TARGET_SELF = '_self';

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
