<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AnchorNavigation;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\AnchorNavigation\AnchorNavigation as AnchorNavigationComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<AnchorNavigation,Document,HomePage>
 */
final class AnchorNavigationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $anchorNavigationComponent = AnchorNavigationComponent::create(
            items: $this->contentRenderer->renderContentChildren(
                $context,
                RenderingUseCase::CONTENT
            ),
            isSticky: $context->current->isSticky,
        );

        return $context->current->isSticky
            ? $anchorNavigationComponent
            : ContentContainerFactory::create(
                $context->current,
                $anchorNavigationComponent,
            );
    }
}
