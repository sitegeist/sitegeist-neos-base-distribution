<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\Content as NeosContent;
use Neos\TimeableNodeVisibility\NodeTypes\Timeable;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypes\NeosLabelProvider;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;

#[NodeTypeDeclaration]
#[InspectorGroupDeclaration(
    name: 'anchor',
    label: 'Anchor',
    icon: 'anchor',
    position: 'start 0',
)]
interface Content extends NeosContent, Timeable, NeosLabelProvider
{
    #[PropertyUiConfiguration(label: 'Anchor', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'anchor')]
    public ?string $anchorId {get;}
}
