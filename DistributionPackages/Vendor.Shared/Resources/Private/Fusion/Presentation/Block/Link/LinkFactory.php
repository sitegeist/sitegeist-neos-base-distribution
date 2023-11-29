<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\ContentRepository\Domain\Projection\Content\TraversableNodeInterface;
use Neos\Neos\Domain\Service\ContentContext;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use GuzzleHttp\Psr7\Uri;
use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Repository\AssetRepository;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Psr\Http\Message\UriInterface;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

final class LinkFactory extends AbstractComponentPresentationObjectFactory implements
    StyleguideCaseFactoryInterface
{
    #[Flow\Inject]
    protected AssetRepository $assetRepository;

    public function resolveRawLinkHref(?string $href, ContentContext $subgraph): ?UriInterface
    {
        $href = $href ?: '';
        if (\mb_substr($href, 0, 7) === 'node://') {
            $targetNode = $subgraph->getNodeByIdentifier(mb_substr($href, 7));
            if ($targetNode instanceof TraversableNodeInterface) {
                return $this->uriService->getNodeUri($targetNode);
            }
        }
        if (\mb_substr($href, 0, 8) === 'asset://') {
            $asset = $this->assetRepository->findByIdentifier(mb_substr($href, 8));
            return $asset instanceof Asset
                ? $this->uriService->getAssetUri($asset)
                : null;
        }

        if (
            \mb_substr($href, 0, 4) === 'http' ||
            \mb_substr($href, 0, 4) === 'tel:' ||
            \mb_substr($href, 0, 7) === 'mailto:'
        ) {
            return new Uri($href);
        }

        return null;
    }
    public static function resolveLinkTargetForRawLinkHref(?string $href, ContentContext $subgraph): LinkTarget
    {
        $href = $href ?: '';

        if (\mb_substr($href, 0, 7) === 'node://') {
            $targetNode = $subgraph->getNodeByIdentifier(mb_substr($href, 7));
            if ($targetNode instanceof NodeInterface) {
                return self::resolveLinkTargetForPotentialShortcut($targetNode);
            }
        }

        return LinkTarget::TARGET_BLANK;
    }

    public static function resolveLinkTargetForPotentialShortcut(NodeInterface $node): LinkTarget
    {
        return $node->getNodeType()->isOfType('Neos.Neos:Shortcut')
        && $node->getProperty('targetMode') === 'selectedTarget'
        && \str_starts_with($node->getProperty('target'), 'asset://')
            ? LinkTarget::TARGET_BLANK
            : LinkTarget::TARGET_SELF;
    }

    public function getDefaultCase(): SlotInterface
    {
        return new Link(
            LinkVariant::VARIANT_REGULAR,
            new Uri('https://neos.io'),
            'Neos CMS',
            LinkTarget::TARGET_BLANK,
            new Text(
                TextColumns::COLUMNS_ONE_COLUMN,
                Value::fromString('Neos CMS')
            ),
            false
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
