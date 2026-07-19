<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\ComponentEngine\Util;

final readonly class Base implements ComponentInterface
{
    private function __construct(
        private string $comment,
        private string $title,
        private string $language,
        private ComponentInterface $content,
        private ?ComponentInterface $headMetaData,
        private ?ComponentInterface $bodyMetaData,
    ) {
    }

    public static function create(
        string $comment,
        string $title,
        string $language,
        ComponentInterface $content,
        ?ComponentInterface $headMetaData,
        ?ComponentInterface $bodyMetaData,
    ): self {
        return new self(
            comment: $comment,
            title: $title,
            language: $language,
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
            . '"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width"><title>'
            . Util::escapeText($this->title)
            . '</title>'
            . '<link rel="icon" href="data:image/png;base64,iVBORw0KGgo=">'
            . $this->headMetaData?->render()
            . '</head>'
            . $this->content->render()
            . $this->bodyMetaData?->render()
            . '</html>';
    }
}
