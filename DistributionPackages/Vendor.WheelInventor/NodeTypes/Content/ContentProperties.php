<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;

trait ContentProperties
{
    use TimeableProperties;

    public readonly ?string $anchorId;
}
