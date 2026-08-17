<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Copy;

enum CopySize : string
{
    case SIZE_SM = 'small';
    case SIZE_MD = 'medium';
    case SIZE_LG = 'large';

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
