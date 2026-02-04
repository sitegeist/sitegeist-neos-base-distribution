<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Accordion\Item;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Accordion\Item\AccordionItem;

final class AccordionItemRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return AccordionItem::create(
            $context->neos->getEditable(
                $context->node,
                'headline',
                true
            ),
            $context->neos->getEditable(
                $context->node,
                'text',
                true
            ),
            false
        );
    }
}
