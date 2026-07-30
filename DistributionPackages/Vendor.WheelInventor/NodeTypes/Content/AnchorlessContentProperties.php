<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\ContentProperties as NeosContentProperties;
use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;

trait AnchorlessContentProperties
{
    use NeosContentProperties;
    use TimeableProperties;
}
