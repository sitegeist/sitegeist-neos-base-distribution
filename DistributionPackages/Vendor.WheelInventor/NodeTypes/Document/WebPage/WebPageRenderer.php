<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document\WebPage;

use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use Vendor\Shared\Components\Block\Text\Text;
use Vendor\Shared\Components\Block\Text\TextColumns;
use PackageFactory\Neos\ComponentEngine\NeosContext;

final class WebPageRenderer implements DocumentNodeRendererInterface
{

    public function renderAsDocument(NeosContext $context): Text {
        return Text::create(
            TextColumns::COLUMNS_ONE_COLUMN,
            $context->nodes->getStringValue($context->node, 'title')
        );
    }
}
