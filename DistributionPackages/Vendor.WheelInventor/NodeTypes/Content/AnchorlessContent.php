<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\Content as NeosContent;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;

#[NodeTypeDeclaration(
    label: '${Neos.Node.labelForNode(node).properties("headline", "title", "text") || Neos.Node.labelForNode(node)}'
)]
trait AnchorlessContent
{
    use NeosContent;
}
