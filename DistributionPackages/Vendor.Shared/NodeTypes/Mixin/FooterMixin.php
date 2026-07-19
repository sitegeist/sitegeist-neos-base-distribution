<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\ContentRepository\Core\Feature\NodeModification\Dto\PropertyScope;
use Neos\Neos\NodeTypes\Document;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\Domain\NodeType\ReferenceRelationDeclaration;
use PackageFactory\OPGM\Domain\Property\PropertyScopeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\NodeTypes\Preset\PlainText;
use Vendor\WheelInventor\NodeTypes\Document\Documents;

#[NodeTypeDeclaration]
#[InspectorGroupDeclaration(
    name: 'footerLinks',
    label: 'Verlinkungen',
    icon: 'link',
    tab: 'footer',
)]
trait FooterMixin
{
    #[PlainText]
    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 1')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly ?string $primaryMenuTitle;

    #[PlainText]
    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 2')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly ?string $secondaryMenuTitle;

    #[PlainText]
    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 3')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly ?string $tertiaryMenuTitle;

    #[ReferenceRelationDeclaration(nodeTypes: new NodeTypeConstraintsDeclaration(
        fqns: [
            Document::class => true,
        ]
    ))]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 1', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly Documents $primaryMenu;

    #[ReferenceRelationDeclaration(nodeTypes: new NodeTypeConstraintsDeclaration(
        fqns: [
            Document::class => true,
        ]
    ))]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 2', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly Documents $secondaryMenu;

    #[ReferenceRelationDeclaration(nodeTypes: new NodeTypeConstraintsDeclaration(
        fqns: [
            Document::class => true,
        ]
    ))]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 3', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public readonly Documents $tertiaryMenu;
}
