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
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProvider;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\Shared\NodeTypes\Mixin\TextProperties;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

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
final readonly class AccordionItem implements Content, HeadlineMixin, TextMixin, OptionalLinkProvider
{
    use ContentProperties;
    use HeadlineProperties;
    use TextProperties;
    use OptionalLinkProperties;

    public function __construct(
        #[PropertyUiConfiguration(label: 'Akkordeon offen?')]
        #[InspectorConfiguration(group: 'accordionOptions')]
        public bool $initiallyOpen = false,
    ) {
    }
}
