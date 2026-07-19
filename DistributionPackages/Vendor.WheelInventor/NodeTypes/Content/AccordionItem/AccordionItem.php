<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AccordionItem;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkMixin;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Akkordeon-Eintrag',
    icon: 'angle-down',
)]
#[InspectorGroupDeclaration(
    name: 'accordionOptions',
    label: 'Akkordeon-Einstellungen',
    icon: 'anchor',
    position: 'folder-open',
)]
#[Flow\Proxy(false)]
final readonly class AccordionItem
{
    use Content;
    use HeadlineMixin;
    use TextMixin;
    use OptionalLinkMixin;

    public function __construct(
        #[PropertyUiConfiguration(label: 'Akkordeon offen?')]
        #[InspectorConfiguration(group: 'accordionOptions')]
        public bool $initiallyOpen = false,
    ) {
    }
}
