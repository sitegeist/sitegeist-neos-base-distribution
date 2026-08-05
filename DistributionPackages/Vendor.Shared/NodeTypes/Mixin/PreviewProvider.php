<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorTabDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\TextAreaEditor\TextAreaEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\NodeTypes\Preset\FourThreeImage;

#[InspectorTabDeclaration(
    name: 'preview',
    label: 'Vorschau',
    icon: 'eye',
    position: '12',
)]
#[InspectorGroupDeclaration(
    name: 'preview',
    label: 'Vorschau',
    icon: 'preview',
    tab: 'preview',
)]
#[NodeTypeDeclaration]
interface PreviewProvider
{
    #[FourThreeImage]
    #[InspectorConfiguration(group: 'preview')]
    public ?ImageSourceProxy $previewImage {get;}

    #[PropertyUiConfiguration(label: 'Vorschau-Überschrift')]
    #[InspectorConfiguration(group: 'preview')]
    public ?string $previewHeadline {get;}

    #[PropertyUiConfiguration(label: 'Vorschau-Text')]
    #[InspectorConfiguration(group: 'preview')]
    #[TextAreaEditorConfiguration]
    public ?string $previewText {get;}
}
