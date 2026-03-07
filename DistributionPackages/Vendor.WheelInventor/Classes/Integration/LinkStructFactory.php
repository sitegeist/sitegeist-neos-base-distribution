<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeAggregateId;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Repository\AssetRepository;
use Neos\Neos\Domain\Link\Link as NeosLink;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;

final class LinkStructFactory
{
    public function __construct(
        private readonly AssetRepository $assetRepository
    ) {
    }

    public function tryForMixin(
        NeosContext $context,
        ?string $propertyName = 'link',
    ): ?LinkStruct {
        $link = $context->nodes->getObjectValue(
            $context->node,
            $propertyName,
            NeosLink::class
        );

        if (!$link) {
            return null;
        }

        $neosLink = $this->resolveLink($link, $context);

        return $link
            ? LinkStruct::create(
                (string)$neosLink->href,
                $neosLink->title,
                implode(" ", $neosLink->rel),
                LinkTarget::from($neosLink->target),
            )
            : null;
    }

    private function resolveLink(
        NeosLink $link,
        NeosContext $context,
        ?string $overrideTitle = null
    ): ?NeosLink {
        $title = $overrideTitle ?? $link->title;

        switch ($link->href->getScheme()) {
            case 'asset':
                $asset = $this->assetRepository->findByIdentifier($link->href->getHost());
                return $asset instanceof Asset
                    ? NeosLink::create(
                        $context->neos->getPersistentResourceUri(
                            $asset->getResource()
                        )->withFragment($link->href->getFragment()),
                        $title,
                        $link->target ?: LinkTarget::TARGET_BLANK->value,
                        $link->rel ?: ['noopener', 'nofollow']
                    )
                    : null;
            case 'node':
                $node = $context->subgraph->findNodeById(NodeAggregateId::fromString($link->href->getHost()));
                return $node instanceof Node
                    ? NeosLink::create(
                        $context->neos->getNodeUri($node)->withFragment($link->href->getFragment()),
                        $title,
                        $link->target ?: LinkTarget::TARGET_SELF->value,
                        $link->rel ?: []
                    )
                    : null;
            default:
                return $link
                    ? NeosLink::create(
                        $link->href,
                        $title,
                        $link->target ?: LinkTarget::TARGET_BLANK->value,
                        $link->rel ?: ['noopener', 'nofollow']
                    )
                    : null;
        }
    }
}
