<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\TextWithHeadline;

use PackageFactory\PHPComponentEngine as _;
use Vendor\Shared\Components\Block\Headline\Headline;
use Vendor\Shared\Components\Block\Text\Text;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class TextWithHeadline implements _\ComponentInterface
{
    /**
     * @param Headline|_\ComponentEnvelopeInterface<Headline> $headline
     * @param Text|_\ComponentEnvelopeInterface<Text> $text
     */
    private function __construct(
        private Headline|_\ComponentEnvelopeInterface $headline,
        private Text|_\ComponentEnvelopeInterface $text,
    ) {
    }

    /**
     * @param Headline|_\ComponentEnvelopeInterface<Headline> $headline
     * @param Text|_\ComponentEnvelopeInterface<Text> $text
     */
    public static function create(
        Headline|_\ComponentEnvelopeInterface $headline,
        Text|_\ComponentEnvelopeInterface $text,
    ): self {
        return new self(
            headline: $headline,
            text: $text,
        );
    }

    public function render(): string
    {
        return '<div class="' . _\Util::joinAttributeValues(['[Block.TextWithHeadline]']) . '"><div>' . $this->headline->render() . '' . $this->text->render() . '</div></div>';
    }
}
