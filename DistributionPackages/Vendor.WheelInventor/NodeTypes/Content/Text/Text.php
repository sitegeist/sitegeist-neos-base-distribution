<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProvider;
use Vendor\Shared\NodeTypes\Mixin\TextColumnsMixin;
use Vendor\Shared\NodeTypes\Mixin\TextColumnsProperties;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\Shared\NodeTypes\Mixin\TextProperties;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Text',
    icon: 'align-left',
)]
#[Flow\Proxy(false)]
final readonly class Text implements Content, HeadlineMixin, TextMixin, TextColumnsMixin, OptionalLinkProvider
{
    use ContentProperties;
    use HeadlineProperties;
    use TextProperties;
    use TextColumnsProperties;
    use OptionalLinkProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return $this->headline->value ?: $this->text->value;
    }
}
