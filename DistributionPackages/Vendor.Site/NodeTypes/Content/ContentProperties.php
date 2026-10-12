<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content;

use Neos\Neos\NodeTypes\ContentProperties as NeosContentProperties;
use Neos\TimeableNodeVisibility\NodeTypes\TimeableProperties;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use Vendor\Site\Integration\TextValue;

trait ContentProperties
{
    use NeosContentProperties;
    use TimeableProperties;

    public readonly ?string $anchorId;

    public readonly ?string $anchorLabel;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return TextValue::firstPlain($this->headline ?? null, $this->title ?? null, $this->text ?? null);
    }
}
