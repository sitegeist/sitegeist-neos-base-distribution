<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\SiteFooter;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Icon\Icon;
use Vendor\Shared\Components\Block\Link\Link;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;
use Vendor\Shared\Components\Block\SiteFooter\SiteFooterItem;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class SiteFooter implements _\ComponentInterface
{
    private function __construct(
        private SiteFooterItem $_2916_SiteFooterItem,
        private SiteFooterItem $_3216_SiteFooterItem,
        private SiteFooterItem $_3516_SiteFooterItem,
        private SiteFooterItem $_3816_SiteFooterItem,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $primaryMenuTitle,
        _\ComponentInterface|string|null $primaryNavigationItems,
        _\ComponentInterface|string|null $secondaryMenuTitle,
        _\ComponentInterface|string|null $secondaryNavigationItems,
        _\ComponentInterface|string|null $thirdMenuTitle,
        _\ComponentInterface|string|null $thirdNavigationItems,
        LinkStruct $facebookLinkStruct,
        LinkStruct $instagramLinkStruct,
        LinkStruct $xingLinkStruct,
        LinkStruct $xLinkStruct,
        LinkStruct $linkedinLinkStruct,
        bool $inBackend,
    ): self {
        return new self(
            _2916_SiteFooterItem: SiteFooterItem::create(
                title: $primaryMenuTitle,
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (($temp = $primaryNavigationItems) === null ? null : $temp),
                    '</div>'
                ),
            ),
            _3216_SiteFooterItem: SiteFooterItem::create(
                title: $secondaryMenuTitle,
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (($temp = $secondaryNavigationItems) === null ? null : $temp),
                    '</div>'
                ),
            ),
            _3516_SiteFooterItem: SiteFooterItem::create(
                title: $thirdMenuTitle,
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (($temp = $thirdNavigationItems) === null ? null : $temp),
                    '</div>'
                ),
            ),
            _3816_SiteFooterItem: SiteFooterItem::create(
                title: 'Folgen Sie uns!',
                content: _\SlotComponent::list(
                    '<div class="flex flex-wrap gap-16 mt-auto">',
                    (($facebookLinkStruct->href !== null) ? Link::create(
                        link: $facebookLinkStruct,
                        variant: LinkVariant::VARIANT_DEFAULT,
                        component: null,
                        inBackend: $inBackend,
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'facebook',
                                class: 'h-24 w-24',
                            )
                        ),
                    ) : null),
                    (($instagramLinkStruct->href !== null) ? Link::create(
                        link: $instagramLinkStruct,
                        variant: LinkVariant::VARIANT_DEFAULT,
                        component: null,
                        inBackend: $inBackend,
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'instagram',
                                class: 'h-24 w-24',
                            )
                        ),
                    ) : null),
                    (($xingLinkStruct->href !== null) ? Link::create(
                        link: $xingLinkStruct,
                        variant: LinkVariant::VARIANT_DEFAULT,
                        component: null,
                        inBackend: $inBackend,
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'xing',
                                class: 'h-24 w-24',
                            )
                        ),
                    ) : null),
                    (($xLinkStruct->href !== null) ? Link::create(
                        link: $xLinkStruct,
                        variant: LinkVariant::VARIANT_DEFAULT,
                        component: null,
                        inBackend: $inBackend,
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'x',
                                class: 'h-24 w-24',
                            )
                        ),
                    ) : null),
                    (($linkedinLinkStruct->href !== null) ? Link::create(
                        link: $linkedinLinkStruct,
                        variant: LinkVariant::VARIANT_DEFAULT,
                        component: null,
                        inBackend: $inBackend,
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'linkedin',
                                class: 'h-24 w-24',
                            )
                        ),
                    ) : null),
                    '</div>'
                ),
            ),
        );
    }

    public function render(): string
    {
        return '<footer data-component="SiteFooter" class="' . _\Util::joinAttributeValues(['group/SiteFooter col-span-full mt-auto bg-brand-grey', 'grid grid-cols-subgrid']) . '"><div class="col-span-content-full grid grid-cols-1 lg:grid-cols-4 gap-24 py-24">' . $this->_2916_SiteFooterItem->render() . '' . $this->_3216_SiteFooterItem->render() . '' . $this->_3516_SiteFooterItem->render() . '' . $this->_3816_SiteFooterItem->render() . '</div></footer>';
    }
}
