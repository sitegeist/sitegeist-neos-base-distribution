<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Anchor;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\SelectBoxEditor\SelectBoxEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\NodeTypes\Preset\PlainText;
use Vendor\WheelInventor\DataSource\AnchorDataSource;
use Vendor\WheelInventor\NodeTypes\Content\AnchorlessContent;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Anker',
    icon: 'anchor',
)]
#[InspectorGroupDeclaration(
    name: 'anchor',
    label: 'Anker',
    icon: 'anchor',
    position: 'start 0',
)]
#[Flow\Proxy(false)]
final readonly class Anchor implements AnchorlessContent
{
    public function __construct(
        #[PropertyUiConfiguration(label: 'Ziel-Anker')]
        #[InspectorConfiguration(group: 'anchor')]
        #[SelectBoxEditorConfiguration(
            placeholder: 'Anker auswählen',
            dataSourceIdentifier: AnchorDataSource::IDENTIFIER,
        )]
        public ?string $targetIdentifier,
        #[PlainText]
        #[InlineEditorConfiguration(placeholder: 'Bitte Titel eingeben')]
        public ?string $title,
    ) {
    }
}
