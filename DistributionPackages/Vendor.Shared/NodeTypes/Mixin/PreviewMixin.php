<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorTabDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\TextAreaEditor\TextAreaEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;
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
trait PreviewMixin
{
    #[FourThreeImage]
    #[InspectorConfiguration(group: 'preview')]
    public readonly ?ImageSourceProxy $previewImage;

    #[PropertyUiConfiguration(label: 'Vorschau-Überschrift')]
    #[InspectorConfiguration(group: 'preview')]
    public readonly ?string $previewHeadline;

    #[PropertyUiConfiguration(label: 'Vorschau-Text')]
    #[InspectorConfiguration(group: 'preview')]
    #[TextAreaEditorConfiguration]
    #[PropertySearchConfiguration(
        fulltextExtractor: '${Indexing.extractInto("text", value)}',
        #        elasticSearchMapping:
        #          type: text
    )]
    public readonly ?string $previewText;
}
