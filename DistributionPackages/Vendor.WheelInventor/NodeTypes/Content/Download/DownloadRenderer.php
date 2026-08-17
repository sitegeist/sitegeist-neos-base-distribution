<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Download;

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
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Download,Document,HomePage>
 */
final class DownloadRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        // @todo: link & inBackend in der Komponente?
        return DownloadsItem::create(
            media: $this->figureFactory->tryForOptionalImageProvider($context->current),
            headline: Headline::create(
                content: $context->neos->getEditableFromProperty($context->current->title, true),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_DIV
            ),
            primaryMetaHeadline: $context->current->asset ? strtoupper($context->current->asset->getFileExtension()) : null,
            secondaryMetaHeadline: $context->current->asset ? Files::bytesToSizeString($context->current->asset->getResource()->getFileSize()) : null,
            link: (!$context->renderingMode->isEdit && $context->current->asset)
                ? LinkStruct::create(
                    href: (string)$context->neos->getPersistentResourceUri($context->current->asset->getResource()),
                    title: $context->current->asset->getTitle(),
                    rel: 'noopener nofollow',
                    target: LinkTarget::TARGET_BLANK
                )
                : null,
        );
    }
}
