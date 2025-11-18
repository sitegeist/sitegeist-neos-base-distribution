<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Headline;

use Neos\Eel\ProtectedContextAwareInterface;

enum HeadlineVariant: string
{
    case VARIANT_REGULAR = 'regular';
    case VARIANT_UPPERCASE = 'uppercase';
}
