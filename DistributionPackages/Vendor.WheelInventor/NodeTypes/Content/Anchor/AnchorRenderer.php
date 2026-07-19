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
        return $this->render($context, false);
    }

    public function renderAsStickyContent(NeosContext $context): ComponentInterface
    {
        return $this->render($context, true);
    }

    private function render(NeosContext $context, bool $sticky): ComponentInterface
    {
        $anchor = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Anchor::class);

        // @todo: link & inBackend in der Komponente?
        return AnchorNavigationItem::create(
            link: LinkStruct::create(
                href: (!$context->renderingMode->isEdit && $anchor->targetIdentifier)
                    ? '#' . $anchor->targetIdentifier
                    : null,
                title: null,
                rel: null,
                target: null
            ),
            title: $context->neos->getEditable(
                $context->node,
                'title',
                true
            ),
            inBackend: $context->renderingMode->isEdit,
            forSticky: $sticky,
        );
    }
}
