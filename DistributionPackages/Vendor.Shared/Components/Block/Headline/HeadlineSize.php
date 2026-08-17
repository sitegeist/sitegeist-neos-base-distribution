<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Headline;

enum HeadlineSize : string
{
    case SIZE_SM = 'small';
    case SIZE_MD = 'medium';
    case SIZE_LG = 'large';
    case SIZE_XL = 'xLarge';

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
