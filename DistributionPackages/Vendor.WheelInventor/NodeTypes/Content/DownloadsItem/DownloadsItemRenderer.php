<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\DownloadsItem;

use Neos\Media\Domain\Model\Document;
use Neos\Utility\Files;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Downloads\Item\DownloadsItem;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\WheelInventor\Integration\FigureFactory;

final class DownloadsItemRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $asset = $context->nodes->getObjectValue(
            $context->node,
            'asset',
            Document::class
        );

        return DownloadsItem::create(
            media: $this->figureFactory->tryForMixin($context),
            headline: Headline::create(
                content: $context->neos->getEditable(
                    $context->node,
                    'title',
                    true
                ),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_DIV
            ),
            primaryMetaHeadline: $asset ? strtoupper((string)$asset->getFileExtension()) : null,
            secondaryMetaHeadline: $asset ? Files::bytesToSizeString($asset->getResource()->getFileSize()) : null,
            link: (!$context->renderingMode->isEdit && $asset)
                ? LinkStruct::create(
                    href: (string)$context->neos->getPersistentResourceUri($asset->getResource()),
                    title: $asset->getTitle(),
                    rel: 'noopener nofollow',
                    target: LinkTarget::TARGET_BLANK
                )
                : LinkStruct::create(
                    href: null,
                    title: null,
                    rel: null,
                    target: null
                ),
            inBackend: $context->renderingMode->isEdit
        );
    }
}
