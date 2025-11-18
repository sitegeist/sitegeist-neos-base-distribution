<?php

declare(strict_types=1);

namespace Vendor\Shared\Integration;

use GuzzleHttp\Psr7\Uri;
use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\NodeAggregateId;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Repository\AssetRepository;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;

final class LinkFactory
{
    public function __construct(
        private readonly AssetRepository $assetRepository,
    ) {
    }

    public function tryForLinkPropertyValues(
        string $link,
        string $linkTitle,
        ContentSubgraphInterface $subgraph,
        SlotInterface $content
    ): ?Link {
        $uri = new Uri($link);
        switch ($uri->getScheme()) {
            case 'asset':
                $asset = $this->assetRepository->findByIdentifier($uri->getHost());
                if (!$asset instanceof Asset) {
                    return null;
                }
                $uri = $this->uriService->getAssetUri($asset);
                $linkTarget = LinkTarget::TARGET_BLANK;
                break;
            case 'node':
                $node = $subgraph->findNodeById(NodeAggregateId::fromString($uri->getHost()));
                if (!$node instanceof Node) {
                    return null;
                }
                $uri = $this->uriService->getNodeUri($node);
                $linkTarget = LinkTarget::TARGET_SELF;
                break;
            default:
                $linkTarget = LinkTarget::TARGET_BLANK;
        }

        return new Link(
            LinkVariant::VARIANT_REGULAR,
            $uri,
            $linkTarget,
            $linkTitle,
            $content,
            false,
        );
    }

    public function forAsset(Asset $asset, SlotInterface $content): Link
    {
        return new Link(
            LinkVariant::VARIANT_REGULAR,
            $this->uriService->getAssetUri($asset),
            LinkTarget::TARGET_BLANK,
            $asset->getLabel(),
            $content,
            false,
        );
    }
}
