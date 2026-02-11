<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\DownloadsItem;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Downloads\Item\DownloadsItem;

final class DownloadsItemRenderer implements ContentNodeRendererInterface
{

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return DownloadsItem::create();
    }
}
