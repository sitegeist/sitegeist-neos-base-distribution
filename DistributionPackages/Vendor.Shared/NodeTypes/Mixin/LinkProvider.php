<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\LinkEditor\LinkEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\NodeTypes\EditableText;
use Vendor\Shared\NodeTypes\Preset\RichText;

#[InspectorGroupDeclaration(
    name: 'link',
    label: 'Link',
    icon: 'link',
)]
#[NodeTypeDeclaration]
interface LinkProvider
{
    #[LinkEditorConfiguration(title: true)]
    #[InspectorConfiguration(group: 'link')]
    #[PropertyUiConfiguration(label: 'Link-Ziel', reloadIfChanged: true)]
    public Link $link {get;}

    #[RichText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Label eingeben')]
    public EditableText $linkLabel {get;}
}
