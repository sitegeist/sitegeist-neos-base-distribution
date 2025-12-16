<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Vendor\Shared\Presentation\Block\Icon\Icon;
use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\StringLike;

#[Flow\Proxy(false)]
final readonly class Button extends AbstractComponentPresentationObject
{
    public function __construct(
        public ButtonVariant $variant,
        public ButtonType $type,
        public ButtonColor $color,
        public StringLike $content,
        public ?Icon $icon,
        public bool $inBackend
    ) {
    }
}
