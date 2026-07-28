<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\DocumentProperties;
use Neos\Neos\NodeTypes\Shortcut as NeosShortcut;
use Neos\Neos\NodeTypes\ShortcutProperties;
use Neos\TimeableNodeVisibility\NodeTypes\Timeable;
use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use Vendor\Shared\NodeTypes\Mixin\PreviewMixin;
use Vendor\Shared\NodeTypes\Mixin\PreviewProvider;

#[NodeTypeDeclaration]
#[Flow\Proxy(false)]
final readonly class Shortcut implements NeosShortcut, PreviewProvider, Timeable
{
    use DocumentProperties;
    use ShortcutProperties;
    use PreviewMixin;
    use TimeableProperties;

    public function __construct(
        public Node $node,
    ) {
    }
}
