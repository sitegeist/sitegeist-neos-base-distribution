<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Domain\NodeAggregate\NodeName;
use Neos\ContentRepository\Domain\Model\Node;
use Neos\Neos\Domain\Service\ContentContext;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Content;
use Vendor\Shared\Presentation\Layout\Page\Page;

final class PageFactory extends AbstractComponentPresentationObjectFactory
{
    public function forHomePage(
        Node $homePage,
        ContentContext $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            new Collection(
                Content::fromNode($homePage->findNamedChildNode(NodeName::fromString('main')))
            )
        );
    }

    public function forWebPage(
        Node $homePage,
        ContentContext $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            new Collection(
                Content::fromNode($homePage->findNamedChildNode(NodeName::fromString('main')))
            )
        );
    }

    public function for404Page(
        Node $errorPage,
        ContentContext $subgraph,
        bool $inBackend
    ): Page {
        return new Page(
            new Collection(
            )
        );
    }
}
