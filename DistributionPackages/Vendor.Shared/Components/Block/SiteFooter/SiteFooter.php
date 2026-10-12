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
        private SiteFooterItem $_28_16_SiteFooterItem,
        private SiteFooterItem $_31_16_SiteFooterItem,
        private SiteFooterItem $_34_16_SiteFooterItem,
        private SiteFooterItem $_37_16_SiteFooterItem,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $primaryMenuTitle,
        _\ComponentInterface|string|null $primaryNavigationItems,
        _\ComponentInterface|string|null $secondaryMenuTitle,
        _\ComponentInterface|string|null $secondaryNavigationItems,
        _\ComponentInterface|string|null $thirdMenuTitle,
        _\ComponentInterface|string|null $thirdNavigationItems,
        ?LinkStruct $facebookLinkStruct,
        ?LinkStruct $instagramLinkStruct,
        ?LinkStruct $xingLinkStruct,
        ?LinkStruct $xLinkStruct,
        ?LinkStruct $linkedinLinkStruct,
    ): self {
        return new self(
            _28_16_SiteFooterItem: SiteFooterItem::create(
                title: (is_string(($temp = $primaryMenuTitle)) ? _\StringComponent::fromString($temp) : $temp),
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (is_string(($temp = $primaryNavigationItems)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
            ),
            _31_16_SiteFooterItem: SiteFooterItem::create(
                title: (is_string(($temp = $secondaryMenuTitle)) ? _\StringComponent::fromString($temp) : $temp),
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (is_string(($temp = $secondaryNavigationItems)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
            ),
            _34_16_SiteFooterItem: SiteFooterItem::create(
                title: (is_string(($temp = $thirdMenuTitle)) ? _\StringComponent::fromString($temp) : $temp),
                content: _\SlotComponent::list(
                    '<div class="flex flex-col gap-8">',
                    (is_string(($temp = $thirdNavigationItems)) ? _\Util::escapeText($temp) : $temp),
                    '</div>',
                ),
            ),
            _37_16_SiteFooterItem: SiteFooterItem::create(
                title: _\StringComponent::fromString('Folgen Sie uns!'),
                content: _\SlotComponent::list(
                    '<div class="flex flex-wrap gap-16 mt-auto">',
                    (($facebookLinkStruct !== null) ? Link::create(
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'facebook',
                                class: 'h-24 w-24',
                            ),
                            '<span class="sr-only">',
                            'Facebook',
                            '</span>',
                        ),
                        link: $facebookLinkStruct,
                        component: null,
                        ariaCurrent: null,
                        variant: LinkVariant::VARIANT_DEFAULT,
                    ) : null),
                    (($instagramLinkStruct !== null) ? Link::create(
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'instagram',
                                class: 'h-24 w-24',
                            ),
                            '<span class="sr-only">',
                            'Instagram',
                            '</span>',
                        ),
                        link: $instagramLinkStruct,
                        component: null,
                        ariaCurrent: null,
                        variant: LinkVariant::VARIANT_DEFAULT,
                    ) : null),
                    (($xingLinkStruct !== null) ? Link::create(
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'xing',
                                class: 'h-24 w-24',
                            ),
                            '<span class="sr-only">',
                            'XING',
                            '</span>',
                        ),
                        link: $xingLinkStruct,
                        component: null,
                        ariaCurrent: null,
                        variant: LinkVariant::VARIANT_DEFAULT,
                    ) : null),
                    (($xLinkStruct !== null) ? Link::create(
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'x',
                                class: 'h-24 w-24',
                            ),
                            '<span class="sr-only">',
                            'X',
                            '</span>',
                        ),
                        link: $xLinkStruct,
                        component: null,
                        ariaCurrent: null,
                        variant: LinkVariant::VARIANT_DEFAULT,
                    ) : null),
                    (($linkedinLinkStruct !== null) ? Link::create(
                        content: _\SlotComponent::list(
                            Icon::create(
                                icon: 'linkedin',
                                class: 'h-24 w-24',
                            ),
                            '<span class="sr-only">',
                            'LinkedIn',
                            '</span>',
                        ),
                        link: $linkedinLinkStruct,
                        component: null,
                        ariaCurrent: null,
                        variant: LinkVariant::VARIANT_DEFAULT,
                    ) : null),
                    '</div>',
                ),
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<footer data-component="SiteFooter" class="' . _\Util::joinAttributeValues('group/SiteFooter col-span-full mt-auto bg-brand-grey', 'grid grid-cols-subgrid') . '"><div class="col-span-content-full grid grid-cols-1 lg:grid-cols-4 gap-24 py-24">' . $this->_28_16_SiteFooterItem->render() . $this->_31_16_SiteFooterItem->render() . $this->_34_16_SiteFooterItem->render() . $this->_37_16_SiteFooterItem->render() . '</div></footer>';
    }
}
