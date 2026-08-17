<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\TileNavigation;

use PackageFactory\ComponentEngine\ComponentList;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\Neos\ComponentEngine\NodeAccessInterface;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\NavigationCard\NavigationCard;
use Vendor\Shared\Components\Block\TileNavigation\TileNavigation as TileNavigationComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\FigureFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;
use Vendor\WheelInventor\NodeTypes\Document\Shortcut;

final class TileNavigationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $tileNavigation = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, TileNavigation::class);
        $inBackend = $context->renderingMode->isEdit;

        $cards = [];
        foreach ($tileNavigation->documents as $document) {
            $cards[] = $this->createNavigationCard(
                $context->nodes,
                $context->neos,
                $document,
                $inBackend,
            );
        }

        return ContentContainerFactory::create(
            $tileNavigation,
            TileNavigationComponent::create(
                $context->neos->getEditableFromProperty($tileNavigation->headline, true),
                ComponentList::list(...$cards)
            )
        );
    }

    private function createNavigationCard(
        NodeAccessInterface $nodeAccess,
        NeosAccessInterface $neosAccess,
        Document|Shortcut $document,
        bool $inBackend,
    ): NavigationCard {
        return NavigationCard::create(
            figure: $this->figureFactory->tryForPreviewImageProvider($document),
            headline: $document->previewHeadline ?: $nodeAccess->getLabel($document->node),
            text: $document->previewText,
            link: $inBackend
                ? null
                : LinkStruct::create(
                    href: (string)$neosAccess->getNodeUri($document->node),
                    title: $nodeAccess->getLabel($document->node),
                    rel: null,
                    target: LinkTarget::TARGET_SELF
                ),
        );
    }
}
