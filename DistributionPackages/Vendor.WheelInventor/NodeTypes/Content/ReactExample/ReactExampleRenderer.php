<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ReactExample;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Application\ReactExample\ReactExample;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class ReactExampleRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $appData = json_encode([
            'endpointBaseUri' => '/placeholder'
        ]) ?: '{}';

        $labels = json_encode([]) ?: '[]';

        return ContentContainerFactory::create(
            $context,
            ReactExample::create(
                headline: $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                appData: $appData,
                labels: $labels
            )
        );
    }
}
