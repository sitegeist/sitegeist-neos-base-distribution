<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use Vendor\Shared\Components\Block\Text\Text;
use Vendor\Shared\Components\Block\Text\TextColumns;
use PackageFactory\Neos\ComponentEngine\NeosContext;

final class TextRenderer implements ContentNodeRendererInterface
{

    public function renderAsContent(NeosContext $context): Text {
        return Text::create(
            TextColumns::COLUMNS_ONE_COLUMN,
            $context->neos->getEditable(
                $context->node,
                'text'
            ));
    }
}
