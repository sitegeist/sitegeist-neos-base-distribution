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
interface SocialMixin
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
    public ?Link $socialFacebookUri {get;}

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
    public ?Link $socialInstagramUri {get;}

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
    public ?Link $socialXingUri {get;}

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
    public ?Link $socialXUri {get;}

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
    public ?Link $socialLinkedinUri {get;}
}
