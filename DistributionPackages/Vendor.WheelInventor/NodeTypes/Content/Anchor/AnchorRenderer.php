<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Anchor;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\AnchorNavigation\AnchorNavigationItem;
use Vendor\Shared\Components\Block\Link\LinkStruct;

final class AnchorRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $targetIdentifier = $context->nodes->getStringValue(
            $context->node,
            'targetIdentifier'
        );
        $parentNode = $context->subgraph->findParentNode($context->node->aggregateId);

        return AnchorNavigationItem::create(
            link: LinkStruct::create(
                href: (!$context->renderingMode->isEdit && $targetIdentifier)
                    ? '#' . $targetIdentifier
                    : null,
                title: null,
                rel: null,
                target: null
            ),
            inBackend: $context->renderingMode->isEdit,
            title: $context->neos->getEditable(
                $context->node,
                'title',
                true
            ),
            forSticky: $parentNode
                ? ($context->nodes->getBoolValue(
                    $parentNode,
                    'isSticky'
                ) ?? false)
                : false
        );
    }
}
