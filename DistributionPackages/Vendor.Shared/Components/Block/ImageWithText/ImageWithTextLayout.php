<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\ImageWithText;

enum ImageWithTextLayout : string
{
    case VARIANT_50_50 = '50-50';
    case VARIANT_66_33 = '66-33';
    case VARIANT_33_66 = '33-66';

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
