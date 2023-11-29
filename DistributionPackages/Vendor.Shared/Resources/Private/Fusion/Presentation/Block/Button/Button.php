<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Vendor\Shared\Presentation\Block\Icon\Icon;
use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;

#[Flow\Proxy(false)]
final class Button extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly ButtonVariant $variant,
        public readonly ButtonType $type,
        public readonly ButtonColor $color,
        public readonly StringLike $content,
        public readonly ?Icon $icon,
        public readonly bool $inBackend
    ) {
    }
}
