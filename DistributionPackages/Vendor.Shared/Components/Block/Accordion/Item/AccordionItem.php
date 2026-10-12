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
        private Headline $_18_24_Headline,
        private Icon $_24_24_Icon,
        private Headline $_33_24_Headline,
        private Icon $_41_24_Icon,
        private Icon $_44_24_Icon,
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
            _18_24_Headline: Headline::create(
                content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_H3,
            ),
            _24_24_Icon: Icon::create(
                icon: 'minus',
                class: 'w-32 h-32 shrink-0',
            ),
            _33_24_Headline: Headline::create(
                content: (is_string(($temp = $headline)) ? _\StringComponent::fromString($temp) : $temp),
                variant: HeadlineVariant::VARIANT_REGULAR,
                size: HeadlineSize::SIZE_MD,
                tag: HeadlineTag::TAG_H3,
            ),
            _41_24_Icon: Icon::create(
                icon: 'plus',
                class: 'w-32 h-32',
            ),
            _44_24_Icon: Icon::create(
                icon: 'minus',
                class: 'w-32 h-32',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return ($this->inBackend ? '<div data-component="AccordionItem" class="accordion-item w-full"><div class="w-full py-24 flex justify-between items-center gap-16">' . $this->_18_24_Headline->render() . $this->_24_24_Icon->render() . '</div><div class="flex flex-col gap-16 md:gap-24 pb-24">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . ((($temp = $this->button) === null) ? '' : $temp->render()) . '</div></div>' : '<sl-details data-component="AccordionItem" class="accordion-item w-full"' . ($this->initialOpen ? ' open' : '') . '><div slot="summary">' . $this->_33_24_Headline->render() . '</div><span slot="expand-icon" class="accordion-item__icon">' . $this->_41_24_Icon->render() . '</span><span slot="collapse-icon" class="accordion-item__icon">' . $this->_44_24_Icon->render() . '</span><div class="flex flex-col gap-16 md:gap-24">' . ((($temp = $this->content) === null) ? '' : $temp->render()) . ((($temp = $this->button) === null) ? '' : $temp->render()) . '</div></sl-details>');
    }
}
