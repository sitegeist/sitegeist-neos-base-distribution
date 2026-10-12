<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Document\HomePage;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentList;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\PageBody\PageBody;
use Vendor\Site\Integration\BaseFactory;
use Vendor\Site\Integration\Base;
use Vendor\Site\Integration\SiteFooterFactory;
use Vendor\Site\Integration\SiteHeaderFactory;

/**
 * @implements DocumentNodeRendererInterface<HomePage,HomePage,HomePage>
 */
final class HomePageRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private readonly BaseFactory $baseFactory,
        private readonly ContentRenderer $contentRenderer,
        private readonly SiteHeaderFactory $siteHeaderFactory,
        private readonly SiteFooterFactory $siteFooterFactory,
    ) {
    }

    public function renderAsDocument(NeosContext $context): Base
    {
        return $this->baseFactory->createWithContent(
            context: $context,
            content: PageBody::create(
                content: ComponentList::list(
                    $this->contentRenderer->forContentCollectionChildNode(
                        $context->documentNode, NodeName::fromString('main'), $context
                    ),
                ),
                siteHeader: $this->siteHeaderFactory->forDocumentNode($context),
                siteFooter: $this->siteFooterFactory->forDocumentNode($context)
            )
        );
    }
}
