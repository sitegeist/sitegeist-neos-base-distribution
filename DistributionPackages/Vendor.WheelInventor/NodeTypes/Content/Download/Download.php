<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Download;

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\Document;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\AssetEditor\AssetEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\MediaConstraintsDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\NodeTypes\EditableText;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalImageProvider;
use Vendor\Shared\NodeTypes\Preset\PlainText;
use Vendor\Shared\NodeTypes\Preset\ThreeFourImage;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Download',
    icon: 'file-download',
)]
#[InspectorGroupDeclaration(
    name: 'asset',
    label: 'Datei',
    icon: 'file',
)]
#[Flow\Proxy(false)]
final readonly class Download implements Content, HeadlineMixin, OptionalImageProvider
{
    use ContentProperties;
    use HeadlineProperties;

    public function __construct(
        #[ThreeFourImage]
        public ?ImageSourceProxy $image,
        #[PlainText]
        #[InlineEditorConfiguration(placeholder: 'Bitte Titel eingeben')]
        public EditableText $title,
        #[PropertyUiConfiguration(label: 'Datei', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'asset')]
        #[AssetEditorConfiguration(
            constraints: new MediaConstraintsDeclaration(
                mediaTypes: ['application/pdf']
            )
        )]
        public ?Document $asset = null,
    ) {
    }
}
