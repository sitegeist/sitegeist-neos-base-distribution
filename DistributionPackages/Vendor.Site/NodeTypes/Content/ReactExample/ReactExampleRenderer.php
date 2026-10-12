<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\ReactExample;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Application\ReactExample\ReactExample as ReactExampleComponent;
use Vendor\Site\Integration\ContentContainerFactory;
use Vendor\Site\NodeTypes\Content\Text\Text;
use Vendor\Site\NodeTypes\Document\Document;
use Vendor\Site\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Text,Document,HomePage>
 */
final class ReactExampleRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $appData = json_encode([
            'endpointBaseUri' => '/placeholder'
        ]) ?: '{}';

        $labels = json_encode([]) ?: '[]';

        return ContentContainerFactory::create(
            $context->current,
            ReactExampleComponent::create(
                headline: $context->neos->getEditableFromProperty($context->current->headline, true),
                appData: $appData,
                labels: $labels
            )
        );
    }
}
