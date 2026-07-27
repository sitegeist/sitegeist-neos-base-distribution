<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Neos\NodeTypes\Document as NeosDocument;
use Neos\Neos\NodeTypes\DocumentProperties;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\StandardSeoProperties;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\StandardSeoPropertiesProvider;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use Vendor\Shared\NodeTypes\Mixin\PreviewMixin;
use Vendor\Shared\NodeTypes\Mixin\PreviewProvider;

#[NodeTypeDeclaration]
abstract readonly class Document implements
    NeosDocument,
    StandardSeoPropertiesProvider,
    PreviewProvider
{
    use DocumentProperties;
    use StandardSeoProperties;
    use PreviewMixin;

    public function __construct(
        public Node $node,
    ) {
    }
}
