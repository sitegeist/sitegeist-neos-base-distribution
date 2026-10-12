<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\ReactExample;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Site\NodeTypes\Content\Content;
use Vendor\Site\NodeTypes\Content\ContentProperties;
use Vendor\Site\Integration\TextValue;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'ReactExample',
    icon: 'smile',
)]
#[Flow\Proxy(false)]
final readonly class ReactExample implements Content, HeadlineMixin
{
    use ContentProperties;
    use HeadlineProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return TextValue::firstPlain($this->headline);
    }
}
