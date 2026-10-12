<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content;

use Neos\Neos\NodeTypes\ContentProperties as NeosContentProperties;
use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use Vendor\Site\Integration\TextValue;

trait AnchorlessContentProperties
{
    use NeosContentProperties;
    use TimeableProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return TextValue::firstPlain($this->headline ?? null, $this->title ?? null);
    }
}
