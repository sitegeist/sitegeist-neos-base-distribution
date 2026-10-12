<?php

declare(strict_types=1);

namespace Vendor\Shared\PaperTiger;

/**
 * Share of the form row a PaperTiger field takes up, see NodeTypes/Override/PaperTiger.FormField.yaml
 */
enum FieldWidth: string
{
    case HALF = 'half';
    case ONE_THIRD = 'oneThird';
    case TWO_THIRDS = 'twoThirds';
    case ONE_SIXTH = 'oneSixth';
    case FIVE_SIXTHS = 'fiveSixths';
}
