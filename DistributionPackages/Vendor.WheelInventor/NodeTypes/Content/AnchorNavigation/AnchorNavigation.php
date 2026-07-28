<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AnchorNavigation;

use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\ContentCollection;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplateDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplates\NodeTemplateChildNodeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\WheelInventor\NodeTypes\Content\Anchor\Anchor;
use Vendor\WheelInventor\NodeTypes\Content\AnchorlessContent;

#[NodeTypeDeclaration(
    constraints: new NodeTypeConstraintsDeclaration(fqns: [
        Anchor::class => true,
    ])
)]
#[NodeTypeUiConfiguration(
    label: 'Anchor Navigation',
    icon: 'file-download',
)]
#[NodeTemplateDeclaration(
    childNodes: [
        'anchor-1' => new NodeTemplateChildNodeDeclaration(
            type: Anchor::class,
        ),
        'anchor-2' => new NodeTemplateChildNodeDeclaration(
            type: Anchor::class,
        ),
        'anchor-3' => new NodeTemplateChildNodeDeclaration(
            type: Anchor::class,
        ),
    ],
)]
#[Flow\Proxy(false)]
final readonly class AnchorNavigation extends ContentCollection implements AnchorlessContent
{
    public function __construct(
        #[PropertyUiConfiguration(label: 'Sticky Navigation?', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'default')]
        public bool $isSticky = false,
    ) {
    }
}
