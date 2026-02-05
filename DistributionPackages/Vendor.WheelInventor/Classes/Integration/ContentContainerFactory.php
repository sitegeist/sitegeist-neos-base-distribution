<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;


#[Flow\Scope('singleton')]
final class ContentContainerFactory
{
    public static function create(NeosContext $context, ComponentInterface $content): ComponentInterface
    {
        $anchorId = $context->nodes->getBoolValue(
            $context->node,
            'anchorId'
        );

        return ContentContainer::create(
            ContentContainerTag::TAG_SECTION,
            $content,
            $anchorId
        );
    }
}
