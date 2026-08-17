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
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Text,Document,HomePage>
 */
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
            $text,
            TextComponent::create(
                columns: $text->columns,
                headline: $context->neos->getEditableFromProperty($context->current->headline, true),
                content: $context->neos->getEditableFromProperty($context->current->text, true),
                button: $this->linkedButtonFactory->tryForLinkProvider($context->current, $context) ?: ''
            )
        );
    }
}
