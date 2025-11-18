<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use GuzzleHttp\Psr7\Uri;
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
        bool $inBackend
    ): SiteFooter {
        return new SiteFooter(
            $site->getProperty('primaryMenuTitle') ?: '',
            new Links(
                ... array_map(
                    fn (Node $link): Link
                    => new Link(
                        LinkVariant::VARIANT_REGULAR,
                        ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            $link->getProperty('title'),
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        Value::fromString($link->getLabel()),
                        $inBackend
                    ),
                    $site->getProperty('primaryMenu') ?: []
                )
            ),
            $site->getProperty('secondaryMenuTitle') ?: '',
            new Links(
                ... array_map(
                    fn (Node $link): Link
                    => new Link(
                        LinkVariant::VARIANT_REGULAR,
                        ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            $link->getProperty('title'),
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        Value::fromString($link->getLabel()),
                        $inBackend
                    ),
                    $site->getProperty('secondaryMenu') ?: []
                )
            ),
            $site->getProperty('thirdMenuTitle') ?: '',
            new Links(
                ... array_map(
                    fn (Node $link): Link
                    => new Link(
                        LinkVariant::VARIANT_REGULAR,
                        ArchaeopteryxLink::create(
                            $this->uriService->getNodeUri($link),
                            $link->getProperty('title'),
                            LinkTarget::TARGET_SELF->value,
                            ['noopener', 'nofollow'],
                        ),
                        Value::fromString($link->getLabel()),
                        $inBackend
                    ),
                    $site->getProperty('thirdMenu') ?: []
                )
            ),
            $site->getProperty('social__facebookUri')
                ? new Uri($site->getProperty('social__facebookUri'))
                : null,
            $site->getProperty('social__instagramUri')
                ? new Uri($site->getProperty('social__instagramUri'))
                : null,
            $site->getProperty('social__xingUri')
                ? new Uri($site->getProperty('social__xingUri'))
                : null,
            $site->getProperty('social__xUri')
                ? new Uri($site->getProperty('social__xUri'))
                : null,
            $site->getProperty('social__linkedinUri')
                ? new Uri($site->getProperty('social__linkedinUri'))
                : null,
        );
    }
}
