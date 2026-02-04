<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Accordion\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Icon\Icon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AccordionItem implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private bool $initialOpen,
        private Headline $_2816_Headline,
        private Icon $_3416_Icon,
        private Icon $_3816_Icon,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        bool $initialOpen,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            initialOpen: $initialOpen,
            _2816_Headline: Headline::create(
                tag: HeadlineTag::TAG_H2,
                size: HeadlineSize::SIZE_MD,
                variant: HeadlineVariant::VARIANT_REGULAR,
                content: $headline,
            ),
            _3416_Icon: Icon::create(
                icon: 'plus',
                class: 'w-20 h-20 group-open/accordion:hidden',
            ),
            _3816_Icon: Icon::create(
                icon: 'minus',
                class: 'w-20 h-20 hidden group-open/accordion:block',
            ),
        );
    }

    public function render(): string
    {
        return '<details data-component="AccordionItem" class="' . _\Util::joinAttributeValues(['w-full group/accordion overflow-hidden', 'last:border-b-2 last:border-gs-gs40 [&amp;:has(&gt;summary:hover)]:border-b-bb-bb60']) . '"' . ($this->initialOpen ? ' open' : '') . '><summary class="' . _\Util::joinAttributeValues(['w-full py-24 flex justify-between items-center', 'cursor-pointer marker:hidden group/summary', 'border-t-2 border-gs-gs40 hover:border-bb-bb60']) . '">' . $this->_2816_Headline->render() . '' . $this->_3416_Icon->render() . '' . $this->_3816_Icon->render() . '</summary><div class="flex flex-col gap-24 pb-24 pt-2 m:pt-4 l:pt-8 xl:pt-16">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div></details>';
    }
}
