<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;

#[Flow\Scope('singleton')]
final class ContentContainerFactory
{
    public static function create(NeosContext $context, ComponentInterface $content): ComponentInterface
    {
        $anchorId = $context->nodes->getStringValue(
            $context->node,
            'anchorId'
        );

        return ContentContainer::create(
            ContentContainerTag::TAG_SECTION,
            ContentContainerVariant::VARIANT_REGULAR,
            $content,
            $anchorId
        );
    }
}
