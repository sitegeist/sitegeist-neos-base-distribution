<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Accordion;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Accordion\Accordion as AccordionComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class AccordionRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $accordion = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Accordion::class);

        return ContentContainerFactory::create(
            $context,
            AccordionComponent::create(
                $context->neos->getEditableFromProperty(
                    $accordion->headline,
                    true
                ),
                $this->contentRenderer->renderContentChildren(
                    $context,
                    RenderingUseCase::CONTENT
                )
            )
        );
    }
}
