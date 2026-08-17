<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\CollectionBasedDownloads;

use Neos\Media\Domain\Model\Document;
use Neos\Media\Domain\Repository\DocumentRepository;
use Neos\Utility\Files;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Downloads\Downloads;
use Vendor\Shared\Components\Block\Downloads\Item\DownloadsItem;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class CollectionBasedDownloadsRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly DocumentRepository $documentRepository,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $collectionBasedDownloads = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, CollectionBasedDownloads::class);
        $assetCollections = $collectionBasedDownloads->assetCollections ?? [];
        $tags = $collectionBasedDownloads->tags ?? [];
        $documentQuery = $this->documentRepository->createQuery();
        /** @var array<Document> $documents */
        $documents = $documentQuery->matching(
            $documentQuery->logicalOr(
                $documentQuery->contains('assetCollections', $assetCollections),
                $documentQuery->contains('tags', $tags),
            )
        )->execute()->toArray();

        return ContentContainerFactory::create(
            $context,
            Downloads::create(
                $context->neos->getEditableFromProperty($collectionBasedDownloads->headline, true),
                ComponentCollection::list(...array_map(
                    // @todo: link & inBackend in der Komponente?
                    fn (Document $document): DownloadsItem => DownloadsItem::create(
                        /** @todo create figure from PDF thumbnail */
                        null,
                        headline: Headline::create(
                            content: $document->getLabel(),
                            variant: HeadlineVariant::VARIANT_REGULAR,
                            size: HeadlineSize::SIZE_MD,
                            tag: HeadlineTag::TAG_DIV
                        ),
                        primaryMetaHeadline: strtoupper($document->getFileExtension()),
                        secondaryMetaHeadline: Files::bytesToSizeString($document->getResource()->getFileSize()),
                        link: (!$context->renderingMode->isEdit)
                            ? LinkStruct::create(
                                href: (string)$context->neos->getPersistentResourceUri($document->getResource()),
                                title: $document->getTitle(),
                                rel: 'noopener nofollow',
                                target: LinkTarget::TARGET_BLANK
                            )
                            : null,
                    ),
                    array_values($documents),
                )),
            )
        );
    }
}
