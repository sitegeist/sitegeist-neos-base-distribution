<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Text;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkMixin;
use Vendor\Shared\NodeTypes\Mixin\TextColumnsMixin;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Text',
    icon: 'align-left',
)]
#[Flow\Proxy(false)]
final readonly class Text
{
    use Content;
    use HeadlineMixin;
    use TextMixin;
    use TextColumnsMixin;
    use OptionalLinkMixin;
}
