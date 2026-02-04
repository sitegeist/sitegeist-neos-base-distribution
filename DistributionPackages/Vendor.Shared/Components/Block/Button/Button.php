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
        private Icon $_2312_Icon,
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
            _2312_Icon: Icon::create(
                icon: 'arrow_right',
                class: 'w-20 h-20',
            ),
        );
    }

    public function render(): string
    {
        return '<' . ($_119_tag = $this->tag->value) . ' data-component="Button" class="' . _\Util::joinAttributeValues(['inline-flex gap-16 items-center min-w-touch min-h-touch copy-medium', match ($this->variant) { ButtonVariant::VARIANT_GHOST => 'hover:text-highlight', default => '' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '' . $this->_2312_Icon->render() . '</' . $_119_tag . '>';
    }
}
