<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\PageBody;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\SiteFooter\SiteFooter;
use Vendor\Shared\Components\Block\SiteHeader\SiteHeader;
use Vendor\Shared\Components\Layout\Grid\PageGrid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class PageBody implements _\ComponentInterface
{
    private function __construct(
        private PageGrid $_1212_PageGrid,
    ) {
    }

    /**
     * @param SiteHeader|_\ComponentEnvelopeInterface<SiteHeader> $siteHeader
     * @param SiteFooter|_\ComponentEnvelopeInterface<SiteFooter> $siteFooter
     */
    public static function create(
        _\ComponentInterface|string|null $content,
        SiteHeader|_\ComponentEnvelopeInterface $siteHeader,
        SiteFooter|_\ComponentEnvelopeInterface $siteFooter,
    ): self {
        return new self(
            _1212_PageGrid: PageGrid::create(
                content: _\SlotComponent::list(
                    $siteHeader,
                    (($temp = $content) === null ? null : $temp),
                    $siteFooter
                ),
            ),
        );
    }

    public function render(): string
    {
        return '<body>' . $this->_1212_PageGrid->render() . '</body>';
    }
}
