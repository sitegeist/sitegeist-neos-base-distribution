<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\ContentRepository\Core\Feature\NodeModification\Dto\PropertyScope;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\Domain\NodeType\ReferenceRelationDeclaration;
use PackageFactory\OPGM\Domain\Property\PropertyScopeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\WheelInventor\NodeTypes\Document\Documents;

#[NodeTypeDeclaration]
#[InspectorGroupDeclaration(
    name: 'footerLinks',
    label: 'Verlinkungen',
    icon: 'link',
    tab: 'footer',
)]
interface FooterMixin
{
    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 1')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public ?string $primaryMenuTitle {get;}

    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 2')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public ?string $secondaryMenuTitle {get;}

    #[PropertyUiConfiguration(label: 'Titel Footer-Navigation - Teil 3')]
    #[InspectorConfiguration(group: 'footerLinks')]
    public ?string $tertiaryMenuTitle {get;}

    #[ReferenceRelationDeclaration]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 1', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public Documents $primaryMenu {get;}

    #[ReferenceRelationDeclaration]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 2', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public Documents $secondaryMenu {get;}

    #[ReferenceRelationDeclaration]
    #[PropertyScopeDeclaration(scope: PropertyScope::SCOPE_NODE_AGGREGATE)]
    #[PropertyUiConfiguration(label: 'Footer-Navigation - Teil 3', reloadIfChanged: true)]
    #[InspectorConfiguration(group: 'footerLinks')]
    public Documents $tertiaryMenu {get;}
}
