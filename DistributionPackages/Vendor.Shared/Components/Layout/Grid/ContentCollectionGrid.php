<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\Grid;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Layout\Grid\ContentCollectionGridVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ContentCollectionGrid implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
        private ContentCollectionGridVariant $variant,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
        ContentCollectionGridVariant $variant,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            variant: $variant,
        );
    }

    public function render(): string
    {
        return '<div data-__neos-insertion-anchor class="' . _\Util::joinAttributeValues(['col-span-full grid grid-cols-1 gap-x-16 md:gap-x-32', match ($this->variant) { ContentCollectionGridVariant::VARIANT_THREE_COLUMNS => 'sm:grid-cols-2 lg:grid-cols-3', ContentCollectionGridVariant::VARIANT_FOUR_COLUMNS => 'sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
