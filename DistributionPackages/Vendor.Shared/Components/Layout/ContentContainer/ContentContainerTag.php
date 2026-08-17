<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\ContentContainer;

enum ContentContainerTag : string
{
    case TAG_DIV = 'div';
    case TAG_SECTION = 'section';

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
