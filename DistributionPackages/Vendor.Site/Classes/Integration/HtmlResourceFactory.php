<?php

declare(strict_types=1);

namespace Vendor\Site\Integration;

use PackageFactory\ComponentEngine\ComponentInterface;
use Psr\Http\Message\UriInterface;

final readonly class HtmlResourceFactory implements ComponentInterface
{
    private function __construct(
        private string $html,
    ) {
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public static function stylesheet(
        UriInterface $href,
        array $attributes = []
    ): self {
        $attrs = self::buildAttributes(array_merge([
            'rel' => 'stylesheet',
            'href' => (string)$href,
        ], $attributes));

        return new self("<link{$attrs}>");
    }

    /**
     * Fonts are requested only once the stylesheet is parsed, the ones used right away are worth
     * requesting earlier. The URL must match the one in the stylesheet, otherwise it is loaded twice.
     */
    public static function fontPreload(UriInterface $href, string $type): self
    {
        $attrs = self::buildAttributes([
            'rel' => 'preload',
            'href' => (string)$href,
            'as' => 'font',
            'type' => $type,
            // fonts are always fetched in CORS mode, without it the preload is not reused
            'crossorigin' => 'anonymous',
        ]);

        return new self("<link{$attrs}>");
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    public static function script(
        UriInterface $src,
        array $attributes = []
    ): self {
        $attrs = self::buildAttributes(array_merge([
            'src' => (string)$src,
        ], $attributes));

        return new self("<script{$attrs}></script>");
    }

    /**
     * @param array<string, scalar|bool|null> $attributes
     */
    private static function buildAttributes(array $attributes): string
    {
        $parts = [];
        foreach ($attributes as $key => $value) {
            if (is_bool($value)) {
                if ($value === true) {
                    $parts[] = $key;
                }
                continue;
            }
            $parts[] = sprintf('%s="%s"', $key, htmlspecialchars((string)$value, ENT_QUOTES));
        }
        return $parts ? ' ' . implode(' ', $parts) : '';
    }

    public function render(): string
    {
        return $this->html;
    }
}
