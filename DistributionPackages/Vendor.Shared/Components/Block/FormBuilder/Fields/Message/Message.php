<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Message;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Message\MessageProps;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Message implements _\ComponentInterface
{
    private function __construct(
        private MessageProps $message,
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        MessageProps $message,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            message: $message,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<div id="' . _\Util::escapeAttributeValue($this->message->id) . '" data-custom-message class="papertiger-message" role="status">' . (($temp = $this->content) === null ? '' : $temp->render()) . '</div>';
    }
}
