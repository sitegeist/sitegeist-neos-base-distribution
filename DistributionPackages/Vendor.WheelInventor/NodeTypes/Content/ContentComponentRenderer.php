<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;

abstract class ContentComponentRenderer implements ContentNodeRendererInterface
{
    final public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $anchorId = $context->node->getProperty('anchorId');

        return ContentContainer::create(
            ContentContainerTag::TAG_SECTION,
            $this->renderContent($context),
            $anchorId
        );
    }

    /**
     * Render only the inner component here
     */
    abstract protected function renderContent(NeosContext $context): ComponentInterface;
}
