<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Anchor;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\AnchorNavigation\Item\AnchorNavigationItem;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Anchor,Document,HomePage>
 */
final class AnchorRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return AnchorNavigationItem::create(
            link: LinkStruct::create(
                href: $context->current->targetIdentifier
                    ? '#' . $context->current->targetIdentifier
                    : null,
                title: null,
                rel: null,
                target: null
            ),
            title: $context->neos->getEditableFromProperty($context->current->title, true),
        );
    }
}
