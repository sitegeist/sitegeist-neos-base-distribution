<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\LinkStruct;
use Vendor\Shared\Components\Block\Link\LinkVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Link implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private LinkStruct $link,
        private ?string $component,
        private LinkVariant $variant,
        private ?bool $inBackend,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        LinkStruct $link,
        ?string $component,
        LinkVariant $variant,
        ?bool $inBackend,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            link: $link,
            component: $component,
            variant: $variant,
            inBackend: $inBackend,
        );
    }

    public function render(): string
    {
        return '<' . ($_129_tag = ($this->inBackend ? 'div' : 'a')) . '' . (($this->component !== null) ? (($temp = $this->component) === null ? '' : ' data-component="' . _\Util::escapeAttributeValue($temp) . '"') : ' data-component="Link"') . '' . ((!$this->inBackend) ? (($temp = $this->link->href) === null ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . (($temp = $this->link->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . ((!$this->inBackend) ? (($temp = $this->link->rel) === null ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . ((!$this->inBackend) ? (($temp = $this->link->target) === null ? '' : ' target="' . _\Util::escapeAttributeValue($temp->value) . '"') : '') . '' .  (($temp = _\Util::joinAttributeValues(...[((!$this->inBackend) ? 'cursor-pointer' : ''), match ($this->variant) { LinkVariant::VARIANT_NONE => 'w-fit', LinkVariant::VARIANT_DEFAULT => ($this->inBackend ? 'link-medium flex' : 'link-medium hover:text-highlight flex'), LinkVariant::VARIANT_MENU_ITEM => ($this->inBackend ? 'link-large lg:link-medium flex h-full items-center' : 'link-large lg:link-medium hover:text-highlight flex h-full items-center'), LinkVariant::VARIANT_MENU_SUB_ITEM => ($this->inBackend ? 'link-medium lg:link-small' : 'link-medium lg:link-small hover:text-highlight') }])) === '' ? '' : ' class="' . $temp . '"') . '>' . (($temp = $this->content) === null ? '' : $temp->render()) . '</' . $_129_tag . '>';
    }
}
