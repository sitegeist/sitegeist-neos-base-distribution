<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\NavigationCard;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Button\ButtonTag;
use Vendor\Shared\Components\Block\Button\ButtonVariant;
use Vendor\Shared\Components\Block\Copy\Copy;
use Vendor\Shared\Components\Block\Copy\CopySize;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Headline\HeadlineSize;
use Vendor\Shared\Components\Block\Headline\HeadlineTag;
use Vendor\Shared\Components\Block\Headline\HeadlineVariant;
use Vendor\Shared\Components\Block\Link\LinkStruct;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class NavigationCard implements _\ComponentInterface
{
    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $figure
     */
    private function __construct(
        private Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|null $figure,
        private LinkStruct $link,
        private bool $inBackend,
        private Headline $_3816_Headline,
        private Copy $_4416_Copy,
        private Button $_4920_Button,
    ) {
    }

    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $figure
     */
    public static function create(
        Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $figure,
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $text,
        LinkStruct $link,
        bool $inBackend,
    ): self {
        return new self(
            figure: is_string($figure) ? _\StringComponent::fromString($figure) : $figure,
            link: $link,
            inBackend: $inBackend,
            _3816_Headline: Headline::create(
                tag: HeadlineTag::TAG_DIV,
                size: HeadlineSize::SIZE_MD,
                variant: HeadlineVariant::VARIANT_REGULAR,
                content: $headline,
            ),
            _4416_Copy: Copy::create(
                size: CopySize::SIZE_MD,
                content: $text,
            ),
            _4920_Button: Button::create(
                tag: ButtonTag::TAG_SPAN,
                variant: ButtonVariant::VARIANT_GHOST,
                content: null,
            ),
        );
    }

    public function render(): string
    {
        return '<' . ($_219_tag = (((!$this->inBackend) && ($this->link->href !== null)) ? 'a' : 'div')) . ' data-component="NavigationCard"' . ((!$this->inBackend) ? (($temp = $this->link->href) === null ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . (($temp = $this->link->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . ((!$this->inBackend) ? (($temp = $this->link->rel) === null ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . ((!$this->inBackend) ? (($temp = $this->link->target) === null ? '' : ' target="' . _\Util::escapeAttributeValue($temp->value) . '"') : '') . ' class="' . _\Util::joinAttributeValues(['flex flex-col w-full h-full relative bg-brand-grey', (((!$this->inBackend) && ($this->link->href !== null)) ? 'cursor-pointer hover:text-highlight' : '')]) . '"><div class="w-full aspect-4/3 overflow-hidden shrink-0">' . (($temp = $this->figure) === null ? '' : $temp->render()) . '</div><div class="flex flex-col justify-between p-16 gap-16 bg-brand-grey h-full">' . $this->_3816_Headline->render() . '' . $this->_4416_Copy->render() . '<div class="mt-auto ml-auto">' . $this->_4920_Button->render() . '</div></div></' . $_219_tag . '>';
    }
}
