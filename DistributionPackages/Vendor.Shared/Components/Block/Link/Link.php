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
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        LinkStruct $link,
        ?string $component,
        LinkVariant $variant,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            link: $link,
            component: $component,
            variant: $variant,
        );
    }

    public function render(): string
    {
        return '<a' . (($this->component !== null) ? (($temp = $this->component) === null ? '' : ' data-component="' . _\Util::escapeAttributeValue($temp) . '"') : ' data-component="Link"') . '' . (($temp = $this->link->href) === null ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link->rel) === null ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link->target) === null ? '' : ' target="' . _\Util::escapeAttributeValue($temp->value) . '"') . ' class="' . _\Util::joinAttributeValues(['w-fit cursor-pointer', match ($this->variant) { LinkVariant::VARIANT_NONE => '', LinkVariant::VARIANT_MENU => 'font-bold hover:text-highlight' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</a>';
    }
}
