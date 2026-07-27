<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\Content as NeosContent;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;

#[NodeTypeDeclaration(
    label: '${Neos.Node.labelForNode(node).properties("headline", "title", "text") || Neos.Node.labelForNode(node)}'
)]
#[InspectorGroupDeclaration(
    name: 'anchor',
    label: 'Anchor',
    icon: 'anchor',
    position: 'start 0',
)]
interface Content extends NeosContent
{
    #[PropertyUiConfiguration(label: 'Anchor', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'anchor')]
    public ?string $anchorId {get;}
}
