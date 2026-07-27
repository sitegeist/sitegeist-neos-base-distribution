<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Accordion;

use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\ContentCollection;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplateDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplates\NodeTemplateChildNodeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\WheelInventor\NodeTypes\Content\AccordionItem\AccordionItem;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Akkordeon',
    icon: 'list',
)]
#[InspectorGroupDeclaration(
    name: 'layout',
    label: 'Layout',
    icon: 'palette',
    position: '40',
)]
#[NodeTypeConstraintsDeclaration(fqns: [
    AccordionItem::class => true,
])]
#[NodeTemplateDeclaration(
    childNodes: [
        'accordion1' => new NodeTemplateChildNodeDeclaration(
            type: AccordionItem::class,
        ),
        'accordion2' => new NodeTemplateChildNodeDeclaration(
            type: AccordionItem::class,
        ),
    ]
)]
#[Flow\Proxy(false)]
final readonly class Accordion extends ContentCollection implements Content
{
    use ContentProperties;
    use HeadlineMixin;
}
