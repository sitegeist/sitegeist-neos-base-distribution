<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\Neos\Domain\Link\Link as NeosLink;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;

final class LinkStructFactory
{
    public static function tryForLink(
        NeosLink $link,
        ContentSubgraphInterface $subgraph,
        NeosAccessInterface $neosAccess,
    ): ?LinkStruct {
        $resolvedLink = $neosAccess->tryResolveLink($link, $subgraph, true);

        return $resolvedLink
            ? LinkStruct::create(
                (string)$resolvedLink->href,
                $link->title,
                implode(
                    ' ',
                    $link->rel ?: match ($link->href->getScheme()) {
                        'node' => [],
                        default => ['noopener', 'nofollow']
                    }
                ),
                $link->target
                    ? LinkTarget::from($link->target)
                    : match ($link->href->getScheme()) {
                        'node' => LinkTarget::TARGET_SELF,
                        default => LinkTarget::TARGET_BLANK,
                    }
            )
            : null;
    }
}
