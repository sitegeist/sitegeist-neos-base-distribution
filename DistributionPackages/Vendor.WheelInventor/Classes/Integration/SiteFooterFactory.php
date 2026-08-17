<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Neos\Domain\Link\Link as NeosLink;
use PackageFactory\ComponentEngine\ComponentList;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\Neos\ComponentEngine\NodeAccessInterface;
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
    /**
     * @param NeosContext<Document,Document,HomePage> $context
     */
    public function forDocumentNode(
        NeosContext $context,
    ): SiteFooter {
        $inBackend = $context->renderingMode->isEdit;

        return SiteFooter::create(
            primaryMenuTitle: $context->site->primaryMenuTitle,
            primaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context->site->primaryMenu,
                $context->nodes,
                $context->neos,
                $inBackend
            ),
            secondaryMenuTitle: $context->site->secondaryMenuTitle,
            secondaryNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context->site->secondaryMenu,
                $context->nodes,
                $context->neos,
                $inBackend
            ),
            thirdMenuTitle: $context->site->tertiaryMenuTitle,
            thirdNavigationItems: $this->createNavigationItemsFromReferenceProperty(
                $context->site->tertiaryMenu,
                $context->nodes,
                $context->neos,
                $inBackend,
            ),
            facebookLinkStruct: $context->site->socialFacebookUri
                ? $this->createSocialLink(
                    $context->site->socialFacebookUri,
                    'Facebook'
                )
                : null,
            instagramLinkStruct: $context->site->socialInstagramUri
                ? $this->createSocialLink(
                    $context->site->socialInstagramUri,
                    'Instagram'
                )
                : null,
            xingLinkStruct: $context->site->socialXingUri
                ? $this->createSocialLink(
                    $context->site->socialXingUri,
                    'Xing'
                )
                : null,
            xLinkStruct: $context->site->socialXUri
                ? $this->createSocialLink(
                    $context->site->socialXUri,
                    'X / Twitter'
                )
                : null,
            linkedinLinkStruct: $context->site->socialLinkedinUri
                ? $this->createSocialLink(
                    $context->site->socialLinkedinUri,
                    'LinkedIn'
                )
                : null,
        );
    }

    /**
     * @return ComponentList<Link>
     */
    private function createNavigationItemsFromReferenceProperty(
        Documents $documents,
        NodeAccessInterface $nodeAccess,
        NeosAccessInterface $neosAccess,
        bool $inBackend
    ): ComponentList {
        /** @var list<Link> $items */
        $items = [];
        try {
            foreach ($documents as $document) {
                $items[] = $this->createNavigationItem($nodeAccess, $neosAccess, $document, $inBackend);
            }
        } catch (ReferenceIsMissing) {
            // then don't
            // @todo this exception should not be thrown for collections, must investigate
        }

        return ComponentList::list(...$items);
    }

    private function createNavigationItem(
        NodeAccessInterface $nodeAccess,
        NeosAccessInterface $neosAccess,
        Document|Shortcut $targetNode,
        bool $inBackend
    ): Link {
        $label = $nodeAccess->getLabel($targetNode->node);

        return Link::create(
            content: $label,
            link: $inBackend
                ? null
                : LinkStruct::create(
                    href: (string)$neosAccess->getNodeUri($targetNode->node),
                    title: $label,
                    rel: null,
                    target: LinkTarget::TARGET_SELF
                ),
            component: null,
            variant: LinkVariant::VARIANT_MENU_SUB_ITEM,
        );
    }

    private function createSocialLink(
        NeosLink $link,
        string $fallbackTitle,
    ): LinkStruct {
        return LinkStruct::create(
            href: (string)$link->href,
            title: $link->title ?: $fallbackTitle,
            rel: implode(' ', $link->rel),
            target: ($link->target ? LinkTarget::tryFrom($link->target) : null) ?: LinkTarget::TARGET_BLANK,
        );
    }
}
