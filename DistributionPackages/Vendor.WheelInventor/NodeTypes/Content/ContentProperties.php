<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content;

use Neos\Neos\NodeTypes\ContentProperties as NeosContentProperties;
use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;

trait ContentProperties
{
    use NeosContentProperties;
    use TimeableProperties;

    public readonly ?string $anchorId;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return $this->headline?->value ?? $this->title?->value ?? $this->text?->value;
    }
}
