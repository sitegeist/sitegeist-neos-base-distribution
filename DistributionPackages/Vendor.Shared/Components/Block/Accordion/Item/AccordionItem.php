<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Accordion\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Icon\Icon;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\LinkedButton\LinkedButton;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class AccordionItem implements _\ComponentInterface
{
    /**
     * @param Button|LinkedButton|_\ComponentEnvelopeInterface<Button|LinkedButton>|_\ComponentInterface|null $button
     */
    private function __construct(
        private ?_\ComponentInterface $content,
        private bool $initialOpen,
        private bool $inBackend,
        private Button|LinkedButton|_\ComponentEnvelopeInterface|_\ComponentInterface|null $button,
        private Headline $_3616_Headline,
        private Icon $_4216_Icon,
        private Icon $_4616_Icon,
    ) {
    }

    /**
     * @param Button|LinkedButton|_\ComponentEnvelopeInterface<Button|LinkedButton>|_\ComponentInterface|null $button
     */
    public static function create(
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $content,
        bool $initialOpen,
        bool $inBackend,
        Button|LinkedButton|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $button,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            initialOpen: $initialOpen,
            inBackend: $inBackend,
            button: is_string($button) ? _\StringComponent::fromString($button) : $button,
            _3616_Headline: Headline::create(
                tag: HeadlineTag::TAG_H2,
                size: HeadlineSize::SIZE_MD,
                variant: HeadlineVariant::VARIANT_REGULAR,
                content: $headline,
            ),
            _4216_Icon: Icon::create(
                icon: 'plus',
                class: 'w-32 h-32 group-open/accordion:hidden',
            ),
            _4616_Icon: Icon::create(
                icon: 'minus',
                class: 'w-32 h-32 hidden group-open/accordion:block',
            ),
        );
    }

    public function render(): string
    {
        return '<' . ($_189_tag = ($this->inBackend ? 'div' : 'details')) . ' data-component="AccordionItem" class="' . _\Util::joinAttributeValues(['w-full group/accordion last:border-b-2 last:border-brand', '[&amp;:has(&gt;summary:hover)+details&gt;summary]:border-highlight', '[&amp;:has(&gt;summary:hover)]:border-highlight', ($this->inBackend ? '' : 'overflow-hidden')]) . '"' . ($this->initialOpen ? ' open' : '') . '><summary class="' . _\Util::joinAttributeValues(['w-full py-24 flex justify-between items-center', 'border-t-2 border-brand marker:hidden hover:border-highlight', ((!$this->inBackend) ? 'cursor-pointer hover:text-highlight select-none' : '')]) . '">' . $this->_3616_Headline->render() . '' . $this->_4216_Icon->render() . '' . $this->_4616_Icon->render() . '</summary><div class="flex flex-col gap-16 md:gap-24 pb-24 pt-2 m:pt-4 l:pt-8 xl:pt-16">' . (($temp = $this->content) === null ? '' : $temp->render()) . '' . (($temp = $this->button) === null ? '' : $temp->render()) . '</div></' . $_189_tag . '>';
    }
}
