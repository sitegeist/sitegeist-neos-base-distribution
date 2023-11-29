<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Headline;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum HeadlineType: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case TYPE_H1 = 'h1';
    case TYPE_H2 = 'h2';
    case TYPE_H3 = 'h3';
    case TYPE_DIV = 'div';
}
