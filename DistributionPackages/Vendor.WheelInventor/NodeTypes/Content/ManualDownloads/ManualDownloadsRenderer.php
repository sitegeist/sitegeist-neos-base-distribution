<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ManualDownloads;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\RenderingUseCase;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Downloads\Downloads;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class ManualDownloadsRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly ContentRenderer $contentRenderer
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $manualDownloads = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, ManualDownloads::class);

        return ContentContainerFactory::create(
            $context,
            Downloads::create(
                $context->neos->getEditableFromProperty($manualDownloads->headline, true),
                $this->contentRenderer->renderContentChildren(
                    $context,
                    RenderingUseCase::CONTENT,
                )
            )
        );
    }
}
