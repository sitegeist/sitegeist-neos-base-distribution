<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ManualDownloads;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Downloads\Downloads;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<ManualDownloads,Document,HomePage>
 */
final class ManualDownloadsRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->current,
            Downloads::create(
                $context->neos->getEditableFromProperty($context->current->headline, true),
                $this->contentRenderer->renderContentChildren(
                    $context,
                    RenderingUseCase::CONTENT,
                )
            )
        );
    }
}
