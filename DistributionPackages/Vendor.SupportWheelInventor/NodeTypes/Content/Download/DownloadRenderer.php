<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\Download;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;
use Vendor\SupportWheelInventor\Integration\DownloadCardFactory;

final class DownloadRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
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
        return new ContentContainer(
            ContentContainerVariant::VARIANT_NONE,
            $this->downloadCardFactory->forDownloadNode($contentNode, $inBackend)
        );
    }
}
