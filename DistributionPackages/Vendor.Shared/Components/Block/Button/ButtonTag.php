<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Button;

enum ButtonTag : string
{
    case TAG_BUTTON = 'button';
    case TAG_SPAN = 'span';

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
