<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use GuzzleHttp\Psr7\Uri;
use Neos\Flow\Annotations as Flow;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Sitegeist\Monocle\PresentationObjects\Domain\StyleguideCaseFactoryInterface;

#[Flow\Scope('singleton')]
final class LinkFactory extends AbstractComponentPresentationObjectFactory implements
    StyleguideCaseFactoryInterface
{
    public function getDefaultCase(): SlotInterface
    {
        return new Link(
            LinkVariant::VARIANT_REGULAR,
            ArchaeopteryxLink::create(
                new Uri('https://neos.io'),
                'Neos CMS',
                ArchaeopteryxLink::TARGET_SELF,
                []
            ),
            new Text(
                TextColumns::COLUMNS_ONE_COLUMN,
                Value::fromString('Neos CMS')
            ),
            false
        );
    }

    public function getUseCases(): \Traversable
    {
        return new \ArrayIterator([]);
    }
}
