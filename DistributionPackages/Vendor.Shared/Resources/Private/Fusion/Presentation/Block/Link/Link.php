<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObject;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Psr\Http\Message\UriInterface;

#[Flow\Proxy(false)]
final class Link extends AbstractComponentPresentationObject
{
    public function __construct(
        public readonly LinkVariant $variant,
        public readonly UriInterface $href,
        public readonly string $title,
        public readonly LinkTarget $target,
        public readonly SlotInterface $content,
        public readonly bool $inBackend
    ) {
    }
}
