<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Text\Text;
use Vendor\Shared\Components\Block\Text\TextColumns;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;

final class TextRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedbuttonFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context,
            Text::create(
                columns: $context->nodes->getObjectValue(
                    $context->node,
                    'columns',
                    TextColumns::class
                ) ?: TextColumns::COLUMNS_ONE_COLUMN,
                headline: $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                content: $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                ),
                button: $this->linkedbuttonFactory->tryForMixin($context) ?: ''
            )
        );
    }
}
