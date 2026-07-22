<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AnchorNavigation;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\AnchorNavigation\AnchorNavigation as AnchorNavigationComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class AnchorNavigationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $anchorNavigation = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, AnchorNavigation::class);

        $anchorNavigationComponent = AnchorNavigationComponent::create(
            items: $this->contentRenderer->renderContentChildren(
                $context,
                RenderingUseCase::CONTENT
            ),
            isSticky: $anchorNavigation->isSticky,
        );

        return $anchorNavigation->isSticky
            ? $anchorNavigationComponent
            : ContentContainerFactory::create(
                $context,
                $anchorNavigationComponent,
            );
    }
}
