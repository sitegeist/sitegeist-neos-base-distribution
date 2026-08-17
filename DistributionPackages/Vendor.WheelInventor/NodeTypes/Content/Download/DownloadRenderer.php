<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Download;

use Neos\Utility\Files;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Downloads\Item\DownloadsItem;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\WheelInventor\Integration\FigureFactory;

final class DownloadRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $download = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Download::class);

        // @todo: link & inBackend in der Komponente?
        return DownloadsItem::create(
            media: $this->figureFactory->tryForOptionalImageProvider($download),
            headline: Headline::create(
                content: $context->neos->getEditableFromProperty($download->title, true),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_DIV
            ),
            primaryMetaHeadline: $download->asset ? strtoupper($download->asset->getFileExtension()) : null,
            secondaryMetaHeadline: $download->asset ? Files::bytesToSizeString($download->asset->getResource()->getFileSize()) : null,
            link: (!$context->renderingMode->isEdit && $download->asset)
                ? LinkStruct::create(
                    href: (string)$context->neos->getPersistentResourceUri($download->asset->getResource()),
                    title: $download->asset->getTitle(),
                    rel: 'noopener nofollow',
                    target: LinkTarget::TARGET_BLANK
                )
                : null,
        );
    }
}
