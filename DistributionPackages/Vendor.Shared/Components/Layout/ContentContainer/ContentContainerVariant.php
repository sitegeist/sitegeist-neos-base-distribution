<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\ContentContainer;

enum ContentContainerVariant : string
{
    case VARIANT_REGULAR = 'regular';
    case VARIANT_NO_PADDING = 'noPadding';

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
