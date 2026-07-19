<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ReactExampleSSR;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'ReactExample (SSR)',
    icon: 'smile',
)]
#[Flow\Proxy(false)]
final readonly class ReactExampleSSR
{
    use Content;
    use HeadlineMixin;
}
