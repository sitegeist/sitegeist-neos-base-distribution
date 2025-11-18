<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Neos\Eel\ProtectedContextAwareInterface;

enum ButtonType: string
{
    case TYPE_REGULAR = 'regular';
    case TYPE_SUBMIT = 'submit';
}
