<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Domain\Model\Node;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Repository\AssetRepository;
use Neos\Neos\Domain\Service\ContentContext;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;

final class LinkedButtonFactory extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly AssetRepository $assetRepository
    ) {
    }

    public function tryForLinkMixin(Node $node, ContentContext $subgraph, bool $inBackend): ?SlotInterface
    {
        $link = $node->getProperty('link');

        if ($link instanceof ArchaeopteryxLink) {
            $link = $this->resolveLink($link, $subgraph);
            $button = new Button(
                ButtonVariant::VARIANT_SOLID,
                ButtonType::TYPE_REGULAR,
                ButtonColor::COLOR_BRAND,
                Value::fromString($link?->title ?: ''),
                Icon::specifiedWith(
                    IconName::NAME_ARROW_RIGHT,
                    IconSize::SIZE_REGULAR,
                    IconColor::COLOR_DEFAULT
                ),
                $inBackend
            );

            return !$inBackend && $link
                ? new Link(
                    LinkVariant::VARIANT_REGULAR,
                    $link,
                    $button,
                    $inBackend
                )
                : $button;
        }

        return null;
    }

    private function resolveLink(ArchaeopteryxLink $link, ContentContext $subgraph): ?ArchaeopteryxLink
    {
        switch ($link->href->getScheme()) {
            case 'asset':
                $asset = $this->assetRepository->findByIdentifier($link->href->getHost());
                return $asset instanceof Asset
                    ? ArchaeopteryxLink::create(
                        $this->uriService->getAssetUri($asset),
                        $link->title,
                        $link->target ?: LinkTarget::TARGET_BLANK->value,
                        $link->rel ?: ['noopener', 'nofollow']
                    )
                    : null;
            case 'node':
                $node = $subgraph->getNodeByIdentifier($link->href->getHost());
                return $node instanceof Node
                    ? ArchaeopteryxLink::create(
                        $this->uriService->getNodeUri($node),
                        $link->title,
                        $link->target ?: LinkTarget::TARGET_SELF->value,
                        $link->rel ?: []
                    )
                    : null;
            default:
                return $link;
        }
    }
}
