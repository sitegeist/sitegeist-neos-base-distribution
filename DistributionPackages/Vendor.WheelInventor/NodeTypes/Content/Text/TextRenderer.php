<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;
use Vendor\Shared\Components\Block\Text\Text as TextComponent;

final class TextRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $text = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Text::class);

        return ContentContainerFactory::create(
            $context,
            TextComponent::create(
                columns: $text->columns,
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
                button: $this->linkedButtonFactory->tryForMixin($context) ?: ''
            )
        );
    }
}
