<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Downloads\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Link\LinkStruct;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class DownloadsItem implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $media,
        private ?_\ComponentInterface $headline,
        private ?_\ComponentInterface $primaryMetaHeadline,
        private ?_\ComponentInterface $secondaryMetaHeadline,
        private ?LinkStruct $link,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $media,
        _\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $primaryMetaHeadline,
        _\ComponentInterface|string|null $secondaryMetaHeadline,
        ?LinkStruct $link,
    ): self {
        return new self(
            media: is_string($media) ? _\StringComponent::fromString($media) : $media,
            headline: is_string($headline) ? _\StringComponent::fromString($headline) : $headline,
            primaryMetaHeadline: is_string($primaryMetaHeadline) ? _\StringComponent::fromString($primaryMetaHeadline) : $primaryMetaHeadline,
            secondaryMetaHeadline: is_string($secondaryMetaHeadline) ? _\StringComponent::fromString($secondaryMetaHeadline) : $secondaryMetaHeadline,
            link: $link,
        );
    }

    public function render(): string
    {
        return '<' . ($_109_tag = (($this->link !== null) ? 'a' : 'div')) . ' data-component="DownloadsItem"' . (($temp = $this->link?->href) === null ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link?->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link?->rel) === null ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') . '' . (($temp = $this->link?->target) === null ? '' : ' target="' . _\Util::escapeAttributeValue($temp->value) . '"') . ' class="' . _\Util::joinAttributeValues(['p-16 flex flex-col justify-between h-full gap-16 bg-brand-grey', (($this->link !== null) ? 'cursor-pointer hover:text-highlight' : '')]) . '"><div class="flex gap-24 h-full items-stretch"><div class="w-1/4 aspect-3/4 flex items-start shrink-0 h-full shadow-md">' . (($temp = $this->media) === null ? '' : $temp->render()) . '</div><div class="flex flex-col justify-between h-full w-full"><div class="h-full flex flex-col justify-between mb-2">' . (($temp = $this->headline) === null ? '' : $temp->render()) . '<div class="flex gap-8 justify-between mt-auto copy-medium"><span>' . (($temp = $this->primaryMetaHeadline) === null ? '' : $temp->render()) . '</span><span>' . (($temp = $this->secondaryMetaHeadline) === null ? '' : $temp->render()) . '</span></div></div></div></div></' . $_109_tag . '>';
    }
}
