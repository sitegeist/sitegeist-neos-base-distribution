<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\TileNavigation;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\Domain\NodeType\ReferenceRelationDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Site\NodeTypes\Content\Content;
use Vendor\Site\NodeTypes\Content\ContentProperties;
use Vendor\Site\NodeTypes\Document\Documents;
use Vendor\Site\Integration\TextValue;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Kachelnavigation',
    icon: 'th-large',
)]
#[InspectorGroupDeclaration(
    name: 'elements',
    label: 'Elemente',
    icon: 'th-large',
)]
#[Flow\Proxy(false)]
final readonly class TileNavigation implements Content, HeadlineMixin
{
    use ContentProperties;
    use HeadlineProperties;

    public function __construct(
        #[ReferenceRelationDeclaration]
        #[InspectorConfiguration(group: 'elements')]
        public Documents $documents,
    ) {
    }

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return TextValue::firstPlain($this->headline);
    }
}
