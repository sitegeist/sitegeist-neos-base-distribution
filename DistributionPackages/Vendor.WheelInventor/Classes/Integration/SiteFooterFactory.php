<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Neos\Domain\Link\Link as NeosLink;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use PackageFactory\OPGM\Domain\ReferenceIsMissing;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkTarget;
use Vendor\Shared\Components\Block\Link\LinkVariant;
use Vendor\Shared\Components\Block\SiteFooter\SiteFooter;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\Documents;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;
use Vendor\WheelInventor\NodeTypes\Document\Shortcut;

final class SiteFooterFactory
{
    public function forDocumentNode(
        NeosContext $context
    ): SiteFooter {
        $inBackend = $context->renderingMode->isEdit;
        $homePage = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, HomePage::class);

        return SiteFooter::create(
            primaryMenuTitle: $homePage->primaryMenuTitle,
            primaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                $homePage->primaryMenu,
                $inBackend
            ),
            secondaryMenuTitle: $homePage->secondaryMenuTitle,
            secondaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                $homePage->secondaryMenu,
                $inBackend
            ),
            thirdMenuTitle: $homePage->tertiaryMenuTitle,
            thirdNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context,
                $homePage->tertiaryMenu,
                $inBackend
            ),
            facebookLinkStruct: $this->createSocialLink(
                $homePage->socialFacebookUri,
                'Facebook'
            ),
            instagramLinkStruct: $this->createSocialLink(
                $homePage->socialInstagramUri,
                'Instagram'
            ),
            xingLinkStruct: $this->createSocialLink(
                $homePage->socialXingUri,
                'Xing'
            ),
            xLinkStruct: $this->createSocialLink(
                $homePage->socialXUri,
                'X / Twitter'
            ),
            linkedinLinkStruct: $this->createSocialLink(
                $homePage->socialLinkedinUri,
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
        Documents $documents,
        bool $inBackend
    ): ?ComponentCollection {
        /** @var list<Link> $items */
        $items = [];
        try {
            foreach ($documents as $document) {
                $items[] = $this->createNavigationItem($context, $document, $inBackend);
            }
        } catch (ReferenceIsMissing) {
            // then don't
            // @todo this exception should not be thrown for collections, must investigate
        }

        return ComponentCollection::list(...$items);
    }

    private function createNavigationItem(
        NeosContext $context,
        Document|Shortcut $targetNode,
        bool $inBackend
    ): Link {
        $label = $context->nodes->getLabel($targetNode->node);

        return Link::create(
            content: $label,
            link: LinkStruct::create(
                href: (string)$context->neos->getNodeUri($targetNode->node),
                title: $label,
                rel: null,
                target: LinkTarget::TARGET_SELF
            ),
            component: null,
            variant: LinkVariant::VARIANT_MENU_SUB_ITEM,
            inBackend: $inBackend,
        );
    }

    private function createSocialLink(
        ?NeosLink $link,
        ?string $title,
    ): LinkStruct {
        return LinkStruct::create(
            href: $link?->href ? (string)$link->href : null,
            title: $link?->title ?: $title,
            rel: implode(' ', $link?->rel ?: []),
            target: ($link?->target ? LinkTarget::tryFrom($link->target) : null) ?: LinkTarget::TARGET_BLANK,
        );
    }
}
