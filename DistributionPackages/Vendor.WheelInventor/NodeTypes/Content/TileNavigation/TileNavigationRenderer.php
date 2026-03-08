<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\TileNavigation;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use Neos\Media\Domain\Model\ImageInterface;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\SlotComponent;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\NavigationCard\NavigationCard;
use Vendor\Shared\Components\Block\TileNavigation\TileNavigation;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class TileNavigationRenderer implements ContentNodeRendererInterface
{
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $documentNodes = $this->resolveReferencedDocuments($context);
        $inBackend = $context->renderingMode->isEdit;

        $cards = array_map(
            fn (Node $documentNode): NavigationCard => $this->createNavigationCard(
                $context,
                $documentNode,
                $inBackend
            ),
            $documentNodes
        );

        return ContentContainerFactory::create(
            $context,
            TileNavigation::create(
                $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                SlotComponent::list(...$cards)
            )
        );
    }

    /**
     * @return array<int,Node>
     */
    private function resolveReferencedDocuments(NeosContext $context): array
    {
        $references = $context->subgraph->findReferences(
            $context->node->aggregateId,
            FindReferencesFilter::create(referenceName: 'documents')
        );

        $documents = [];
        foreach ($references as $reference) {
            if ($reference->node instanceof Node) {
                $documents[] = $reference->node;
            }
        }
        return $documents;
    }

    private function createNavigationCard(
        NeosContext $context,
        Node $documentNode,
        bool $inBackend
    ): NavigationCard {
        return NavigationCard::create(
            figure: $this->createFigureForDocument($context, $documentNode),
            headline: $documentNode->getProperty('previewHeadline') ?: $context->nodes->getLabel($documentNode),
            text: $documentNode->getProperty('previewText') ?: '',
            link: $inBackend
                ? LinkStruct::create(
                    href: null,
                    title: null,
                    rel: null,
                    target: null
                )
                : LinkStruct::create(
                    href: (string)$context->neos->getNodeUri($documentNode),
                    title: $context->nodes->getLabel($documentNode),
                    rel: null,
                    target: LinkTarget::TARGET_SELF
                ),
            inBackend: $inBackend
        );
    }

    private function createFigureForDocument(NeosContext $context, Node $documentNode): Figure
    {
        $previewImage = $context->nodes->getObjectValue(
            $documentNode,
            'previewImage',
            ImageInterface::class
        );
        $fallbackImage = $context->nodes->getObjectValue(
            $documentNode,
            'image',
            ImageInterface::class
        );

        $image = $previewImage ?: $fallbackImage;
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
            alt: $documentNode->getProperty($previewImage ? 'previewImage__alt' : 'image__alt') ?: null,
            title: $documentNode->getProperty($previewImage ? 'previewImage__title' : 'image__title') ?: null,
            class: null
        );
    }
}
