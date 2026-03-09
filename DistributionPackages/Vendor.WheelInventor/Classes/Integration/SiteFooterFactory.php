<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\Link\LinkVariant;
use Vendor\Shared\Components\Block\SiteFooter\SiteFooter;

final class SiteFooterFactory
{
    public function forDocumentNode(
        NeosContext $context
    ): SiteFooter {
        $inBackend = $context->renderingMode->isEdit;

        return SiteFooter::create(
            primaryMenuTitle: $context->nodes->getStringValue($context->siteNode, 'primaryMenuTitle'),
            primaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                'primaryMenu',
                $inBackend
            ),
            secondaryMenuTitle: $context->nodes->getStringValue($context->siteNode, 'secondaryMenuTitle'),
            secondaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                'secondaryMenu',
                $inBackend
            ),
            thirdMenuTitle: $context->nodes->getStringValue($context->siteNode, 'thirdMenuTitle'),
            thirdNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                'thirdMenu',
                $inBackend
            ),
            facebookLinkStruct: $this->createSocialLink(
                $context->nodes->getStringValue($context->siteNode, 'social__facebookUri'),
                'Facebook'
            ),
            instagramLinkStruct: $this->createSocialLink(
                $context->nodes->getStringValue($context->siteNode, 'social__instagramUri'),
                'Instagram'
            ),
            xingLinkStruct: $this->createSocialLink(
                $context->nodes->getStringValue($context->siteNode, 'social__xingUri'),
                'Xing'
            ),
            xLinkStruct: $this->createSocialLink(
                $context->nodes->getStringValue($context->siteNode, 'social__xUri'),
                'X / Twitter'
            ),
            linkedinLinkStruct: $this->createSocialLink(
                $context->nodes->getStringValue($context->siteNode, 'social__linkedinUri'),
                'LinkedIn'
            ),
            inBackend: $inBackend
        );
    }

    /**
     * @return ComponentCollection<Link>|null
     */
    private function createNavigationItemsFromReferenceProperty(
        NeosContext $context,
        string $propertyName,
        bool $inBackend
    ): ?ComponentCollection {
        $references = $context->subgraph->findReferences(
            $context->siteNode->aggregateId,
            FindReferencesFilter::create(referenceName: $propertyName)
        );

        /** @var list<Link> $items */
        $items = [];
        foreach ($references as $reference) {
            $targetNode = $reference->node;
            if (!$targetNode instanceof Node) {
                continue;
            }

            $items[] = $this->createNavigationItem($context, $targetNode, $inBackend);
        }

        return ComponentCollection::list(...$items);
    }

    private function createNavigationItem(
        NeosContext $context,
        Node $targetNode,
        bool $inBackend
    ): Link {
        $label = $context->nodes->getLabel($targetNode);
        return Link::create(
            content: $label,
            link: LinkStruct::create(
                href: (string)$context->neos->getNodeUri($targetNode),
                title: $label,
                rel: null,
                target: LinkTarget::TARGET_SELF
            ),
            component: null,
            variant: LinkVariant::VARIANT_MENU_SUB_ITEM,
            inBackend: $inBackend
        );
    }

    private function createSocialLink(
        ?string $href,
        string $title
    ): LinkStruct {
        return LinkStruct::create(
            href: $href ?: null,
            title: $title,
            rel: null,
            target: LinkTarget::TARGET_BLANK
        );
    }
}
