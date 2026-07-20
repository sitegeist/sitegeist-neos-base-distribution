<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Button;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Button\ButtonTag;
use Vendor\Shared\Components\Block\Button\ButtonVariant;
use Vendor\Shared\Components\Block\Icon\Icon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Button implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private ButtonTag $tag,
        private ButtonVariant $variant,
        private Icon $_3012_Icon,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        ButtonTag $tag,
        ButtonVariant $variant,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            tag: $tag,
            variant: $variant,
            _3012_Icon: Icon::create(
                icon: 'arrow-right',
                class: 'w-24 h-24',
            ),
        );
    }

    public function render(): string
    {
        return '<' . ($_119_tag = $this->tag->value) . ' data-component="Button" class="' . _\Util::joinAttributeValues(['flex gap-16 items-center w-fit copy-medium', match ($this->tag) { ButtonTag::TAG_BUTTON => 'cursor-pointer', default => '' }, match ($this->variant) { ButtonVariant::VARIANT_REGULAR => 'border min-w-touch min-h-touch border-brand px-24 py-8 hover:text-highlight hover:border-highlight', ButtonVariant::VARIANT_SOLID => 'bg-brand min-w-touch min-h-touch text-brand-contrast px-24 py-8 hover:bg-highlight', ButtonVariant::VARIANT_GHOST => 'hover:text-highlight' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '' . $this->_3012_Icon->render() . '</' . $_119_tag . '>';
    }
}
