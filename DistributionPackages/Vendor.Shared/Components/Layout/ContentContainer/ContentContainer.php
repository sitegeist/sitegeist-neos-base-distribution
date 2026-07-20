<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\ContentContainer;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ContentContainer implements _\ComponentInterface
{
    private function __construct(
        private ContentContainerTag $tagName,
        private ContentContainerVariant $variant,
        private ?_\ComponentInterface $content,
        private ?string $anchorId,
    ) {
    }

    public static function create(
        ContentContainerTag $tagName,
        ContentContainerVariant $variant,
        _\ComponentInterface|string|null $content,
        ?string $anchorId,
    ): self {
        return new self(
            tagName: $tagName,
            variant: $variant,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            anchorId: $anchorId,
        );
    }

    public function render(): string
    {
        return '<' . ($_109_tag = $this->tagName->value) . '' . (($temp = $this->anchorId) === null ? '' : ' id="' . _\Util::escapeAttributeValue($temp) . '"') . ' class="' . _\Util::joinAttributeValues(['grid grid-cols-subgrid h-fit', match ($this->variant) { ContentContainerVariant::VARIANT_REGULAR => 'my-16 sm:my-24 lg:my-32 col-span-content-full', ContentContainerVariant::VARIANT_NO_PADDING => '' }]) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</' . $_109_tag . '>';
    }
}
