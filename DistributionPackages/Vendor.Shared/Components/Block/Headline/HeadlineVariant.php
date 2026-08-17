<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Headline;

enum HeadlineVariant : string
{
    case VARIANT_REGULAR = 'regular';
    case VARIANT_UPPERCASE = 'uppercase';

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
