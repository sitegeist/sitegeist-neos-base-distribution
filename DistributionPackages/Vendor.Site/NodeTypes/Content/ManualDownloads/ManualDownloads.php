<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\ManualDownloads;

use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\ContentCollection;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplateDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTemplates\NodeTemplateChildNodeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Site\NodeTypes\Content\Content;
use Vendor\Site\NodeTypes\Content\ContentProperties;
use Vendor\Site\NodeTypes\Content\Download\Download;
use Vendor\Site\Integration\TextValue;

#[NodeTypeDeclaration(
    constraints: new NodeTypeConstraintsDeclaration(fqns: [
        Download::class => true,
    ])
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
final readonly class ManualDownloads extends ContentCollection implements Content, HeadlineMixin
{
    use ContentProperties;
    use HeadlineProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return TextValue::firstPlain($this->headline);
    }
}
