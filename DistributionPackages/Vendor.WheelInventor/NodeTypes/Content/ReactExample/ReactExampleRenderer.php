<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ReactExample;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Application\ReactExample\ReactExample as ReactExampleComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class ReactExampleRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $reactExample = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, ReactExample::class);
        $appData = json_encode([
            'endpointBaseUri' => '/placeholder'
        ]) ?: '{}';

        $labels = json_encode([]) ?: '[]';

        return ContentContainerFactory::create(
            $context,
            ReactExampleComponent::create(
                headline: $context->neos->getEditableFromProperty($reactExample->headline, true),
                appData: $appData,
                labels: $labels
            )
        );
    }
}
