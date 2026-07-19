<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\SelectBoxEditor\EnumSelectBoxEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\Components\Block\Text\TextColumns;

#[InspectorGroupDeclaration(
    name: 'textFormatting',
    label: 'Textformatierung',
    icon: 'align-left',
)]
#[NodeTypeDeclaration]
trait TextColumnsMixin
{
    #[EnumSelectBoxEditorConfiguration]
    #[PropertyUiConfiguration(
        label: 'Spalten',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'textFormatting')]
    public readonly TextColumns $columns;
}
