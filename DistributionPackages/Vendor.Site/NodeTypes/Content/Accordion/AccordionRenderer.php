<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\Accordion;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Accordion\Accordion as AccordionComponent;
use Vendor\Site\Integration\ContentContainerFactory;
use Vendor\Site\NodeTypes\Document\Document;
use Vendor\Site\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Accordion,Document,HomePage>
 */
final class AccordionRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->current,
            AccordionComponent::create(
                $context->neos->getEditableFromProperty(
                    $context->current->headline,
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
