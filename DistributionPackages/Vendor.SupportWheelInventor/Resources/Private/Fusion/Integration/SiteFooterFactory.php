<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use GuzzleHttp\Psr7\Uri;
use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Filter\FindReferencesFilter;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Core\SharedModel\Node\ReferenceName;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\Links;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;
use Vendor\Shared\Presentation\Block\SiteFooter\SiteFooter;

final class SiteFooterFactory extends AbstractComponentPresentationObjectFactory
{
    public function forSite(
        Node $site,
        ContentSubgraphInterface $subgraph,
        bool $inBackend
    ): SiteFooter {
        return new SiteFooter(
            primaryMenuTitle: self::getStringValue($site, 'primaryMenuTitle') ?: '',
            primaryNavigationItems: new Links(
                ... array_map(
                    fn (Node $link): Link
                    => new Link(
                        variant: LinkVariant::VARIANT_REGULAR,
                        link: ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            self::getStringValue($link, 'title') ?: '',
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        content: Value::fromString($this->getNodeLabel($link)),
                        inBackend: $inBackend
                    ),
                    iterator_to_array($subgraph->findReferences(
                        $site->aggregateId,
                        FindReferencesFilter::create(
                            referenceName: ReferenceName::fromString('primaryMenu')
                        )
                    )->getNodes()),
                )
            ),
            secondaryMenuTitle: self::getStringValue($site, 'secondaryMenuTitle') ?: '',
            secondaryNavigationItems: new Links(
                ... array_map(
                    fn (Node $link): Link
                    => new Link(
                        variant: LinkVariant::VARIANT_REGULAR,
                        link: ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            self::getStringValue($link, 'title') ?: '',
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        content: Value::fromString($this->getNodeLabel($link)),
                        inBackend: $inBackend
                    ),
                    iterator_to_array($subgraph->findReferences(
                        $site->aggregateId,
                        FindReferencesFilter::create(
                            referenceName: ReferenceName::fromString('secondaryMenu')
                        )
                    )->getNodes())
                )
            ),
            thirdMenuTitle: self::getStringValue($site, 'thirdMenuTitle') ?: '',
            thirdNavigationItems: new Links(
                ... array_map(
                    fn (Node $link): Link => new Link(
                        variant: LinkVariant::VARIANT_REGULAR,
                        link: ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            self::getStringValue($link, 'title') ?: '',
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        content: Value::fromString($this->getNodeLabel($link)),
                        inBackend: $inBackend
                    ),
                    iterator_to_array($subgraph->findReferences(
                        $site->aggregateId,
                        FindReferencesFilter::create(
                            referenceName: ReferenceName::fromString('thirdMenu')
                        )
                    )->getNodes())
                )
            ),
            facebookUri: (is_string($facebookUri = $site->getProperty('social__facebookUri')))
                ? new Uri($facebookUri)
                : null,
            instagramUri: (is_string($instagramUri = $site->getProperty('social__instagramUri')))
                ? new Uri($instagramUri)
                : null,
            xingUri: (is_string($xingUri = $site->getProperty('social__xingUri')))
                ? new Uri($xingUri)
                : null,
            xUri: (is_string($xUri = $site->getProperty('social__xUri')))
                ? new Uri($xUri)
                : null,
            linkedinUri: (is_string($linkedInUri = $site->getProperty('social__linkedinUri')))
                ? new Uri($linkedInUri)
                : null,
        );
    }
}
