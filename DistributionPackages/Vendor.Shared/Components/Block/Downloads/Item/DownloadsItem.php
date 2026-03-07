<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Downloads\Item;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Figure\Figure;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Link\LinkStruct;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class DownloadsItem implements _\ComponentInterface
{
    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $media
     * @param Headline|_\ComponentEnvelopeInterface<Headline>|_\ComponentInterface|null $headline
     */
    private function __construct(
        private Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|null $media,
        private Headline|_\ComponentEnvelopeInterface|_\ComponentInterface|null $headline,
        private ?_\ComponentInterface $primaryMetaHeadline,
        private ?_\ComponentInterface $secondaryMetaHeadline,
        private LinkStruct $link,
        private bool $inBackend,
    ) {
    }

    /**
     * @param Figure|_\ComponentEnvelopeInterface<Figure>|_\ComponentInterface|null $media
     * @param Headline|_\ComponentEnvelopeInterface<Headline>|_\ComponentInterface|null $headline
     */
    public static function create(
        Figure|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $media,
        Headline|_\ComponentEnvelopeInterface|_\ComponentInterface|string|null $headline,
        _\ComponentInterface|string|null $primaryMetaHeadline,
        _\ComponentInterface|string|null $secondaryMetaHeadline,
        LinkStruct $link,
        bool $inBackend,
    ): self {
        return new self(
            media: is_string($media) ? _\StringComponent::fromString($media) : $media,
            headline: is_string($headline) ? _\StringComponent::fromString($headline) : $headline,
            primaryMetaHeadline: is_string($primaryMetaHeadline) ? _\StringComponent::fromString($primaryMetaHeadline) : $primaryMetaHeadline,
            secondaryMetaHeadline: is_string($secondaryMetaHeadline) ? _\StringComponent::fromString($secondaryMetaHeadline) : $secondaryMetaHeadline,
            link: $link,
            inBackend: $inBackend,
        );
    }

    public function render(): string
    {
        return '<' . ($_149_tag = (((!$this->inBackend) && ($this->link->href !== null)) ? 'a' : 'div')) . ' data-component="DownloadsItem"' . ((!$this->inBackend) ? (($temp = $this->link->href) === null ? '' : ' href="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . (($temp = $this->link->title) === null ? '' : ' title="' . _\Util::escapeAttributeValue($temp) . '"') . '' . ((!$this->inBackend) ? (($temp = $this->link->rel) === null ? '' : ' rel="' . _\Util::escapeAttributeValue($temp) . '"') : '') . '' . ((!$this->inBackend) ? (($temp = $this->link->target) === null ? '' : ' target="' . _\Util::escapeAttributeValue($temp->value) . '"') : '') . ' class="' . _\Util::joinAttributeValues(['p-16 flex flex-col justify-between h-full gap-16 bg-brand-grey', (((!$this->inBackend) && ($this->link->href !== null)) ? 'cursor-pointer hover:text-highlight' : '')]) . '"><div class="flex gap-24 h-full items-stretch"><div class="w-1/4 aspect-3/4 flex items-start shrink-0 h-full shadow-md">' . (($temp = $this->media) === null ? '' : $temp->render()) . '</div><div class="flex flex-col justify-between h-full w-full"><div class="h-full flex flex-col justify-between mb-2">' . (($temp = $this->headline) === null ? '' : $temp->render()) . '<div class="flex gap-8 justify-between mt-auto copy-medium"><span>' . (($temp = $this->primaryMetaHeadline) === null ? '' : $temp->render()) . '</span><span>' . (($temp = $this->secondaryMetaHeadline) === null ? '' : $temp->render()) . '</span></div></div></div></div></' . $_149_tag . '>';
    }
}
