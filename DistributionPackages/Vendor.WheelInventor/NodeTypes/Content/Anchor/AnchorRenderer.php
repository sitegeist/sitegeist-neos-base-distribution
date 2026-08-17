<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Anchor;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\AnchorNavigation\Item\AnchorNavigationItem;
use Vendor\Shared\Components\Block\Link\LinkStruct;

final class AnchorRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $anchor = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Anchor::class);

        return AnchorNavigationItem::create(
            link: $context->renderingMode->isEdit
                ? null
                : LinkStruct::create(
                    href: $anchor->targetIdentifier
                        ? '#' . $anchor->targetIdentifier
                        : null,
                    title: null,
                    rel: null,
                    target: null
                ),
            title: $context->neos->getEditableFromProperty($anchor->title, true),
        );
    }
}
