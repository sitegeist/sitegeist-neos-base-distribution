<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\Content as NeosContent;
use Neos\Neos\NodeTypes\Timeable;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypes\NeosLabelProvider;

#[NodeTypeDeclaration]
interface AnchorlessContent extends NeosContent, Timeable, NeosLabelProvider
{
}
