<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteHeader;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\MenuButton\MenuButton;
use Vendor\Shared\Components\Block\SiteHeader\MainNavigation\MainNavigation;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class SiteHeader implements _\ComponentInterface
{
    /**
     * @param Link|_\ComponentEnvelopeInterface<Link> $homeLink
     * @param MainNavigation|_\ComponentEnvelopeInterface<MainNavigation> $mainNavigation
     */
    private function __construct(
        private Link|_\ComponentEnvelopeInterface $homeLink,
        private MainNavigation|_\ComponentEnvelopeInterface $mainNavigation,
        private MenuButton $_1916_MenuButton,
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
            homeLink: $homeLink,
            mainNavigation: $mainNavigation,
            _1916_MenuButton: MenuButton::create(),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<header data-component="SiteHeader" class="' . _\Util::joinAttributeValues('group/SiteHeader col-span-full sticky top-0', 'grid grid-cols-subgrid z-50 bg-brand-grey h-header') . '"><div class="col-span-content-full flex justify-between w-full items-center">' . $this->homeLink->render() . $this->mainNavigation->render() . $this->_1916_MenuButton->render() . '</div></header>';
    }
}
