<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Text\Text;
use Vendor\Shared\Components\Block\Text\TextColumns;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class TextRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->node,
            Text::create(
                $context->nodes->getObjectValue(
                    $context->node,
                    'columns',
                    TextColumns::class
                ) ?: TextColumns::COLUMNS_ONE_COLUMN,
                $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                )
            )
        );
    }
}
