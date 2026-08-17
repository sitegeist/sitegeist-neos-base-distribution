<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\Util;
use PackageFactory\Neos\Seo\Components\SeoMetaTags\SeoMetaTags;

final readonly class Base implements ComponentInterface
{
    private function __construct(
        private string $comment,
        private string $language,
        private SeoMetaTags $seoMetaTags,
        private ComponentInterface $content,
        private ?ComponentInterface $headMetaData,
        private ?ComponentInterface $bodyMetaData,
    ) {
    }

    public static function create(
        string $comment,
        string $language,
        SeoMetaTags $seoMetaTags,
        ComponentInterface $content,
        ?ComponentInterface $headMetaData,
        ?ComponentInterface $bodyMetaData,
    ): self {
        return new self(
            comment: $comment,
            language: $language,
            seoMetaTags: $seoMetaTags,
            content: $content,
            headMetaData: $headMetaData,
            bodyMetaData: $bodyMetaData,
        );
    }

    public function render(): string
    {
        return
            '<!DOCTYPE html>'
            . $this->comment
            . '<html lang="'
            . Util::escapeAttributeValue($this->language)
            . '"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width">'
            . $this->seoMetaTags->render()
            . '<link rel="icon" href="data:image/png;base64,iVBORw0KGgo=">'
            . $this->headMetaData?->render()
            . '</head>'
            . $this->content->render()
            . $this->bodyMetaData?->render()
            . '</html>';
    }
}
