<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\Node;
use PackageFactory\ComponentEngine\ComponentInterface;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[Flow\Scope('singleton')]
final class ContentContainerFactory
{
    public static function create(
        Node $contentNode,
        ComponentInterface $content,
        ContentContainerVariant $variant = ContentContainerVariant::VARIANT_REGULAR,
    ): ComponentInterface {
        return ContentContainer::create(
            ContentContainerTag::TAG_SECTION,
            $variant,
            $content,
            $contentNode instanceof Content ? $contentNode->anchorId : null,
        );
    }
}
