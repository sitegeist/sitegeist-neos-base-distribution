<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ManualDownloads;

use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\ContentCollection;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplateDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplates\NodeTemplateChildNodeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\Download\Download;

#[NodeTypeDeclaration]
#[NodeTypeConstraintsDeclaration(
    fqns: [
        Download::class => true,
    ]
)]
#[NodeTypeUiConfiguration(
    label: 'Downloads (Manuell)',
    icon: 'download',
)]
#[NodeTemplateDeclaration(
    childNodes: [
        'download-1' => new NodeTemplateChildNodeDeclaration(
            type: Download::class,
        ),
        'download-2' => new NodeTemplateChildNodeDeclaration(
            type: Download::class,
        ),
    ]
)]
#[Flow\Proxy(false)]
final readonly class ManualDownloads extends ContentCollection
{
    use Content;
    use HeadlineMixin;
}
