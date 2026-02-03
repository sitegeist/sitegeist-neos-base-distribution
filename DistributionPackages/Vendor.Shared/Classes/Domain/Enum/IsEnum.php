<?php

declare(strict_types=1);

namespace Vendor\Shared\Domain\Enum;

use Neos\Flow\Annotations as Flow;

/**
 * The specification for enum classes
 */
#[Flow\Proxy(false)]
final class IsEnum
{
    public static function isSatisfiedByClassName(string $className): bool
    {
        return class_exists($className)
            && is_subclass_of($className, \BackedEnum::class);
    }
}
