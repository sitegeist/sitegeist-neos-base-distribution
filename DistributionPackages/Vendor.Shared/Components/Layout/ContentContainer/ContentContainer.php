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
    ) {
    }

    public static function create(
        ContentContainerTag $tagName,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            tagName: $tagName,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<' . ($_89_tag = $this->tagName->value) . ' class="' . _\Util::joinAttributeValues(['max-w-screen-xl mx-auto', 'py-24 sm:py-32 lg:py-40 xl:py-48']) . '">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</' . $_89_tag . '>';
    }
}
