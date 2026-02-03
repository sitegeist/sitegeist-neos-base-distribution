<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use Vendor\Shared\Components\Block\Text\Text;
use Vendor\Shared\Components\Block\Text\TextColumns;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;

final class TextRenderer implements ContentNodeRendererInterface
{

    public function renderAsContent(NeosContext $context): ComponentInterface {
        return ContentContainer::create(
            ContentContainerTag::TAG_SECTION,
            Text::create(
                TextColumns::COLUMNS_ONE_COLUMN,
                $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                )
            )
        );
    }
}
