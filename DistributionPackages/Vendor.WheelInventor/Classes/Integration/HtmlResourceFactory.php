<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

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
