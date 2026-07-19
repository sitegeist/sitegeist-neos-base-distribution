<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\LinkEditor\LinkEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\LinkTypes;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\WebLinkOptions;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;

#[InspectorGroupDeclaration(
    name: 'social',
    label: 'Soziale Medien',
    icon: 'share-alt',
    tab: 'footer',
)]
#[NodeTypeDeclaration]
trait SocialMixin
{
    #[PropertyUiConfiguration(
        label: 'Facebook',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'social')]
    #[LinkEditorConfiguration(
        linkTypes: new LinkTypes(
            new WebLinkOptions(
                enabled: true,
            )
        )
    )]
    public readonly ?Link $socialFacebookUri;

    #[PropertyUiConfiguration(
        label: 'Instagram',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'social')]
    #[LinkEditorConfiguration(
        linkTypes: new LinkTypes(
            new WebLinkOptions(
                enabled: true,
            )
        )
    )]
    public readonly ?Link $socialInstagramUri;

    #[PropertyUiConfiguration(
        label: 'Xing',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'social')]
    #[LinkEditorConfiguration(
        linkTypes: new LinkTypes(
            new WebLinkOptions(
                enabled: true,
            )
        )
    )]
    public readonly ?Link $socialXingUri;

    #[PropertyUiConfiguration(
        label: 'X',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'social')]
    #[LinkEditorConfiguration(
        linkTypes: new LinkTypes(
            new WebLinkOptions(
                enabled: true,
            )
        )
    )]
    public readonly ?Link $socialXUri;

    #[PropertyUiConfiguration(
        label: 'Linkedin',
        reloadIfChanged: true,
    )]
    #[InspectorConfiguration(group: 'social')]
    #[LinkEditorConfiguration(
        linkTypes: new LinkTypes(
            new WebLinkOptions(
                enabled: true,
            )
        )
    )]
    public readonly ?Link $socialLinkedinUri;
}
