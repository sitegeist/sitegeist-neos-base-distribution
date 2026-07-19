<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Neos\NodeTypes\Document as NeosDocument;
use Neos\Neos\NodeTypes\DocumentProperties;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\CanonicalLinkMixin;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\CanonicalLinkProvider;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\OpenGraphMetadataMixin;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\OpenGraphMetadataProvider;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\SeoMetaTagsMixin;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\SeoMetaTagsProvider;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\SeoTabProvider;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\TitleOverrideMixin;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\TitleOverrideProvider;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use Vendor\Shared\NodeTypes\Mixin\PreviewMixin;
use Vendor\Shared\NodeTypes\Mixin\PreviewProvider;

#[NodeTypeDeclaration]
abstract readonly class Document implements
    NeosDocument,
    CanonicalLinkProvider,
    OpenGraphMetadataProvider,
    SeoMetaTagsProvider,
    SeoTabProvider,
    TitleOverrideProvider,
    PreviewProvider
{
    use CanonicalLinkMixin;
    use OpenGraphMetadataMixin;
    use SeoMetaTagsMixin;
    use TitleOverrideMixin;
    use PreviewMixin;
    use DocumentProperties;

    public function __construct(
        public Node $node,
    ) {
    }
}
