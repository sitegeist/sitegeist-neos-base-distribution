<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\DownloadsItem;

use Neos\Media\Domain\Model\Document;
use Neos\Media\Domain\Model\ImageInterface;
use Neos\Utility\Files;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Downloads\Item\DownloadsItem;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;

final class DownloadsItemRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $asset = $context->nodes->getObjectValue(
            $context->node,
            'asset',
            Document::class
        );

        return DownloadsItem::create(
            media: $this->createMedia($context),
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

    private function createMedia(NeosContext $context): Figure
    {
        $image = $context->nodes->getObjectValue(
            $context->node,
            'image',
            ImageInterface::class
        );

        if (!$image) {
            return Figure::create(
                src: null,
                alt: null,
                title: null,
                class: null
            );
        }

        return Figure::create(
            src: (string)$context->neos->getPersistentResourceUri($image->getResource()),
            alt: $context->nodes->getStringValue($context->node, 'image__alt'),
            title: $context->nodes->getStringValue($context->node, 'image__title'),
            class: null
        );
    }

}
