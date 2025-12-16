<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\DownloadList;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Media\Domain\Model\Document;
use Neos\Media\Domain\Repository\DocumentRepository;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\CacheSegment;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Presentation\Layout\Grid\Grid;
use Vendor\Shared\Presentation\Layout\Grid\GridVariant;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;
use Vendor\SupportWheelInventor\Integration\DownloadCardFactory;

final class DownloadListRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly DocumentRepository $documentRepository,
        private readonly DownloadCardFactory $downloadCardFactory,
    ) {
    }

    public function renderAsContent(
        Node $contentNode,
        Node $documentNode,
        Node $siteNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface {
        $query = $this->documentRepository->createQuery();
        $constraints = [];
        $assetCollectionIds = $contentNode->getProperty('assetCollections');
        if ($assetCollectionIds) {
            $constraints[] = $query->contains('assetCollections', $assetCollectionIds);
        }
        $tagIds = $contentNode->getProperty('tags');
        if ($tagIds) {
            $constraints[] = $query->contains('tags', $tagIds);
        }

        /** @var array<Document> $documents */
        $documents = $constraints
            ? $query->matching(
                $query->logicalAnd(...$constraints)
            )->execute()->toArray()
            : [];

        $umlautSearch = ['Ä','ä','Ö','ö','Ü','ü','ß'];
        $umlautReplace = ['A','a','O','o','U','u','ss'];

        uasort(
            $documents,
            fn (Document $documentA, Document $documentB)
            =>
                str_replace($umlautSearch, $umlautReplace, $documentA->getTitle())
                <=>
                str_replace($umlautSearch, $umlautReplace, $documentB->getTitle())
        );

        return new ContentContainer(
            variant: ContentContainerVariant::VARIANT_REGULAR,
            content: new Stack(
                variant: StackVariant::VARIANT_REGULAR,
                content: new Stack(
                    variant: StackVariant::VARIANT_SPACE_Y_4,
                    content: Collection::fromSlots(... array_filter([
                        $contentNode->getProperty('headline') || $inBackend
                            ? new Headline(
                                variant: HeadlineVariant::VARIANT_REGULAR,
                                type: HeadlineType::TYPE_H2,
                                content: Editable::fromNodeProperty($contentNode, 'headline')
                            )
                            : null,
                        new CacheSegment(
                            content: new Grid(
                                variant: GridVariant::VARIANT_3_COL_GAP,
                                content: Collection::fromIterable(
                                    $documents,
                                    fn (Document $asset): SlotInterface => new ContentContainer(
                                        variant: ContentContainerVariant::VARIANT_NONE,
                                        content: $this->downloadCardFactory->forAsset($asset, $inBackend, null)
                                    )
                                )
                            ),
                            prototypeName: 'Vendor.SupportWheelInventor:CacheSegment.DownloadList'
                        )
                    ]))
                )
            )
        );
    }
}
