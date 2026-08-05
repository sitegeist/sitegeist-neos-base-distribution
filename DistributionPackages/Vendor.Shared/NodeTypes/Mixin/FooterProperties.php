<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Vendor\WheelInventor\NodeTypes\Document\Documents;

/**
 * Backing trait for {@see FooterMixin}
 */
trait FooterProperties
{
    public readonly ?string $primaryMenuTitle;

    public readonly ?string $secondaryMenuTitle;

    public readonly ?string $tertiaryMenuTitle;

    public readonly Documents $primaryMenu;

    public readonly Documents $secondaryMenu;

    public readonly Documents $tertiaryMenu;
}
