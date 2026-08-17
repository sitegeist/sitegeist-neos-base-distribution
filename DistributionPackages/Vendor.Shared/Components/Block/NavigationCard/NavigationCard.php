<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\NavigationCard;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Button\ButtonTag;
use Vendor\Shared\Components\Block\Button\ButtonVariant;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class NavigationCard implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $figure,
        private ?LinkStruct $link,
        private Headline $_3216_Headline,
        private Copy $_3816_Copy,
        private Button $_4020_Button,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $figure,
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $text,
        ?LinkStruct $link,
    ): self {
        return new self(
            figure: is_string($figure) ? _\StringComponent::fromString($figure) : $figure,
            link: $link,
            _3216_Headline: Headline::create(
                content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_DIV,
            ),
            _3816_Copy: Copy::create(
                content: (is_string(($temp = $text)) ? _\StringComponent::fromString($temp) : $temp),
                size: CopySize::SIZE_MD,
            ),
            _4020_Button: Button::create(
                content: null,
                tag: ButtonTag::TAG_SPAN,
                variant: ButtonVariant::VARIANT_GHOST,
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<' . ($_189_tag = (((($temp = $this->link) === null) ? false : true) ? 'a' : 'div')) . ' data-component="NavigationCard"' . ((($temp = $this->link?->href) === null) ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') . ((($temp = $this->link?->title) === null) ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . ((($temp = $this->link?->rel) === null) ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') . ((($temp = $this->link?->target) === null) ? '' : ' target="' . $temp->asAttributeValue() . '"') . ' class="' . _\Util::joinAttributeValues('flex flex-col w-full h-full relative bg-brand-grey', (((($temp = $this->link) === null) ? false : true) ? 'cursor-pointer hover:text-highlight' : '')) . '"><div class="w-full aspect-4/3 overflow-hidden shrink-0">' . ((($temp = $this->figure) === null) ? '' : $temp->render()) . '</div><div class="flex flex-col justify-between p-16 gap-16 bg-brand-grey h-full">' . $this->_3216_Headline->render() . $this->_3816_Copy->render() . '<div class="mt-auto ml-auto">' . $this->_4020_Button->render() . '</div></div></' . $_189_tag . '>';
    }
}
