<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document\NotFoundPage;

use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\Neos\ComponentEngine\Integration\ContentRenderer;
use PackageFactory\Neos\ComponentEngine\Integration\DocumentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Layout\PageBody\PageBody;
use Vendor\WheelInventor\Integration\BaseFactory;
use Vendor\WheelInventor\Integration\Base;
use Vendor\WheelInventor\Integration\SiteFooterFactory;
use Vendor\WheelInventor\Integration\SiteHeaderFactory;

final class NotFoundPageRenderer implements DocumentNodeRendererInterface
{
    public function __construct(
        private BaseFactory $baseFactory,
        private ContentRenderer $contentRenderer,
        private readonly SiteHeaderFactory $siteHeaderFactory,
        private readonly SiteFooterFactory $siteFooterFactory,
    ) {
    }

    public function renderAsDocument(NeosContext $context): Base {
        return $this->baseFactory->createWithContent(
            $context,
            PageBody::create(
                content: ComponentCollection::list(
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
