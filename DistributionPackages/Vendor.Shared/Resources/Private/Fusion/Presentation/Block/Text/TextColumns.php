<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Text;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum TextColumns: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case COLUMNS_ONE_COLUMN = 'oneColumn';
    case COLUMNS_TWO_COLUMNS = 'twoColumns';
}
