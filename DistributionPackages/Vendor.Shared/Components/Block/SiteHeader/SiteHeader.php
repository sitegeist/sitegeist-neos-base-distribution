<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteHeader;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\MenuButton\MenuButton;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigation;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;
use Vendor\Shared\Components\Layout\Grid\Grid;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class SiteHeader implements _\ComponentInterface
{
    private function __construct(
        private ContentContainer $_1812_ContentContainer,
    ) {
    }

    /**
     * @param Link|_\ComponentEnvelopeInterface<Link> $homeLink
     * @param MainNavigation|_\ComponentEnvelopeInterface<MainNavigation> $mainNavigation
     */
    public static function create(
        Link|_\ComponentEnvelopeInterface $homeLink,
        MainNavigation|_\ComponentEnvelopeInterface $mainNavigation,
    ): self {
        return new self(
            _1812_ContentContainer: ContentContainer::create(
                tagName: ContentContainerTag::TAG_DIV,
                variant: ContentContainerVariant::VARIANT_NO_PADDING,
                anchorId: null,
                content: _\SlotComponent::list(
                    '<div class="h-header flex justify-between w-full items-center">',
                    $homeLink,
                    $mainNavigation,
                    MenuButton::create(),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return '<header data-component="SiteHeader" class="group/SiteHeader fixed w-full top-0 flex flex-col z-50 bg-brand-grey h-header">' . $this->_1812_ContentContainer->render() . '</header>';
    }
}
