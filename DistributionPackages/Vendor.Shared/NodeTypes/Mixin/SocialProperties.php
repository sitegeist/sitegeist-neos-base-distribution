<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;

/**
 * Backing trait for {@see SocialMixin}
 */
trait SocialProperties
{
    public readonly ?Link $socialFacebookUri;

    public readonly ?Link $socialInstagramUri;

    public readonly ?Link $socialXingUri;

    public readonly ?Link $socialXUri;

    public readonly ?Link $socialLinkedinUri;
}
