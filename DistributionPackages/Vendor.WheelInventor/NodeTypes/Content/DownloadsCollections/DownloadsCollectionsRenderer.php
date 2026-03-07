<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\DownloadsCollections;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Downloads\Downloads;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class DownloadsCollectionsRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context,
            Downloads::create(
                $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                'TODO'
            )
        );
    }
}
