<?php

declare(strict_types=1);

namespace Vendor\Site\Integration;

use Neos\Neos\Domain\Property\EditableText;

/**
 * The inline editors store HTML, even in plain text fields an "&" ends up as "&amp;". Wherever
 * such a value is used as text (node labels, tab labels, lengths), it has to be decoded first,
 * otherwise "&amp;" shows up literally once it is escaped again.
 */
final class TextValue
{
    public static function plain(?EditableText $text): string
    {
        $plain = html_entity_decode(strip_tags($text->value ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $plain) ?? $plain);
    }

    /**
     * The first text that is not empty, e.g. the headline and the text as fallback for a label
     */
    public static function firstPlain(?EditableText ...$texts): ?string
    {
        foreach ($texts as $text) {
            $plain = self::plain($text);
            if ($plain !== '') {
                return $plain;
            }
        }

        return null;
    }
}
