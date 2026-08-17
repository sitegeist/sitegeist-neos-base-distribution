<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ReactExampleSSR;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'ReactExample (SSR)',
    icon: 'smile',
)]
#[Flow\Proxy(false)]
final readonly class ReactExampleSSR implements Content, HeadlineMixin
{
    use ContentProperties;
    use HeadlineProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return $this->headline->value;
    }
}
