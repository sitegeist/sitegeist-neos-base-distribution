<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AnchorNavigation;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\AnchorNavigation\AnchorNavigation;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class AnchorNavigationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context,
            AnchorNavigation::create(
                items: $this->contentRenderer->renderContentChildren(
                    $context,
                    RenderingUseCase::CONTENT
                )
            )
        );
    }
}
