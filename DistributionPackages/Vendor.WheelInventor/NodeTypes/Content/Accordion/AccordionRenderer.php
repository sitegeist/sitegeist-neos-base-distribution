<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Accordion;

use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Accordion\Accordion;
use Vendor\WheelInventor\NodeTypes\Content\ContentComponentRenderer;

final class AccordionRenderer extends ContentComponentRenderer
{
    protected function renderContent(NeosContext $context): ComponentInterface
    {
        return Accordion::create(
            $context->neos->getEditable(
                $context->node,
                'headline',
                true
            ),
            $context->neos->getEditable(
                $context->node,
                'headline',
                true
            )
        );
    }
}
