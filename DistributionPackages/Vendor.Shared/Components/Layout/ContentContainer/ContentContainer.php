<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\ContentContainer;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class ContentContainer implements _\ComponentInterface
{
    private function __construct(
        private ContentContainerTag $tagName,
        private ?_\ComponentInterface $content,
        private ?string $anchorId,
    ) {
    }

    public static function create(
        ContentContainerTag $tagName,
        _\ComponentInterface|string|null $content,
        ?string $anchorId,
    ): self {
        return new self(
            tagName: $tagName,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            anchorId: $anchorId,
        );
    }

    public function render(): string
    {
        return '<' . ($_99_tag = $this->tagName->value) . '' . (($temp = $this->anchorId) === null ? '' : ' id="' . _\Util::escapeAttributeValue($temp) . '"') . ' data-component="ContentContainer" class="' . _\Util::joinAttributeValues(['max-w-content-full mx-auto', 'py-16 sm:py-24 lg:py-32']) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</' . $_99_tag . '>';
    }
}
