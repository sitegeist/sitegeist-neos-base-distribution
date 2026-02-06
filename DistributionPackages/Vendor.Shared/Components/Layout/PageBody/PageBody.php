<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\PageBody;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\SiteHeader\SiteHeader;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class PageBody implements _\ComponentInterface
{
    /**
     * @param SiteHeader|_\ComponentEnvelopeInterface<SiteHeader> $siteHeader
     */
    private function __construct(
        private ?_\ComponentInterface $content,
        private SiteHeader|_\ComponentEnvelopeInterface $siteHeader,
    ) {
    }

    /**
     * @param SiteHeader|_\ComponentEnvelopeInterface<SiteHeader> $siteHeader
     */
    public static function create(
        _\ComponentInterface|string|null $content,
        SiteHeader|_\ComponentEnvelopeInterface $siteHeader,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            siteHeader: $siteHeader,
        );
    }

    public function render(): string
    {
        return '<body>' . $this->siteHeader->render() . '<main>' . (($temp = $this->content) === null ? '' : $temp->render()) . '</main><footer>footer</footer></body>';
    }
}
