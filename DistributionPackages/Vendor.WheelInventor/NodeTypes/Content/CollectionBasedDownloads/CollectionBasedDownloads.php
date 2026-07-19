<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\CollectionBasedDownloads;

use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\AssetCollection;
use Neos\Media\Domain\Model\Tag;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\SelectBoxEditor\SelectBoxEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\Application\AssetCollectionProvider;
use Vendor\Shared\Application\TagProvider;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Downloads (Sammlungen)',
    icon: 'download',
)]
#[InspectorGroupDeclaration(
    name: 'downloads',
    label: 'Downloads',
    icon: 'download',
)]
#[Flow\Proxy(false)]
final readonly class CollectionBasedDownloads
{
    use Content;
    use HeadlineMixin;

    /**
     * @param list<AssetCollection> $assetCollections
     * @param list<Tag> $tags
     */
    public function __construct(
        #[PropertyUiConfiguration(label: 'Sammlungen', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'downloads')]
        #[SelectBoxEditorConfiguration(
            allowEmpty: true,
            placeholder: 'Sammlungen wählen',
            multiple: true,
            dataSourceIdentifier: AssetCollectionProvider::IDENTIFIER,
        )]
        public array $assetCollections,
        #[PropertyUiConfiguration(label: 'Tags', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'downloads')]
        #[SelectBoxEditorConfiguration(
            allowEmpty: true,
            placeholder: 'Tags wählen',
            multiple: true,
            dataSourceIdentifier: TagProvider::IDENTIFIER,
        )]
        public array $tags,
    ){
    }
}
