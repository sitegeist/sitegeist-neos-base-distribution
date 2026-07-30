<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\Components\Block\Text\TextColumns;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProperties;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProvider;
use Vendor\Shared\NodeTypes\Mixin\TextColumnsMixin;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Text',
    icon: 'align-left',
)]
#[Flow\Proxy(false)]
final readonly class Text implements Content, OptionalLinkProvider
{
    use ContentProperties;
    use HeadlineMixin;
    use TextMixin;
    use TextColumnsMixin;
    use OptionalLinkProperties;

    public function __construct(
        public TextColumns $columns = TextColumns::COLUMNS_TWO_COLUMNS,
    ) {
    }
}
