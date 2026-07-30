<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ReactExampleSSR;

use Neos\Flow\Package\PackageManager;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Application\ReactExampleSSR\ReactExampleSSR as ReactExampleSSRComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class ReactExampleSSRRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly PackageManager $packageManager
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $reactExampleSSR = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, ReactExampleSSR::class);
        $appData = json_encode([
            'endpointBaseUri' => '/placeholder'
        ]) ?: '{}';
        $labels = json_encode([
            'label.test' => 'Test'
        ]) ?: '{}';

        $react = shell_exec(
            "npx tsx "
            . $this->packageManager->getPackage('Vendor.Shared')->getPackagePath()
            . "/Components/Application/ReactExampleSSR/SSRScript.js '"
            . $appData . "' '" . $labels . "'"
        );

        return ContentContainerFactory::create(
            $context,
            ReactExampleSSRComponent::create(
                headline: $context->neos->getEditableFromProperty($reactExampleSSR->headline, true),
                appData: $appData,
                labels: $labels,
                renderedApplication: $react ?: null
            )
        );
    }
}
