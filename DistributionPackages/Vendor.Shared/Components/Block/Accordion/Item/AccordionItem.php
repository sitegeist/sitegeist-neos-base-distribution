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
        private bool $inBackend,
        private ?_\ComponentInterface $button,
        private Headline $_32_16_Headline,
        private Icon $_38_16_Icon,
        private Icon $_39_16_Icon,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        bool $initialOpen,
        bool $inBackend,
        _\ComponentInterface|string|null $button,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            initialOpen: $initialOpen,
            inBackend: $inBackend,
            button: is_string($button) ? _\StringComponent::fromString($button) : $button,
            _32_16_Headline: Headline::create(
                content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_H2,
            ),
            _38_16_Icon: Icon::create(
                icon: 'plus',
                class: 'w-32 h-32 group-open/accordion:hidden',
            ),
            _39_16_Icon: Icon::create(
                icon: 'minus',
                class: 'w-32 h-32 hidden group-open/accordion:block',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<' . ($_14_8_tag = ($this->inBackend ? 'div' : 'details')) . ' data-component="AccordionItem" class="' . _\Util::joinAttributeValues('w-full group/accordion last:border-b-2 last:border-brand', '[&amp;:has(&gt;summary:hover)+details&gt;summary]:border-highlight', '[&amp;:has(&gt;summary:hover)]:border-highlight', ($this->inBackend ? '' : 'overflow-hidden')) . '"' . ($this->initialOpen ? ' open' : '') . '><summary class="' . _\Util::joinAttributeValues('w-full py-24 flex justify-between items-center', 'border-t-2 border-brand marker:hidden hover:border-highlight', ((!$this->inBackend) ? 'cursor-pointer hover:text-highlight select-none' : '')) . '">' . $this->_32_16_Headline->render() . $this->_38_16_Icon->render() . $this->_39_16_Icon->render() . '</summary><div class="flex flex-col gap-16 md:gap-24 pb-24 pt-2 m:pt-4 l:pt-8 xl:pt-16">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . ((($temp = $this->button) === null) ? '' : $temp->render()) . '</div></' . $_14_8_tag . '>';
    }
}
