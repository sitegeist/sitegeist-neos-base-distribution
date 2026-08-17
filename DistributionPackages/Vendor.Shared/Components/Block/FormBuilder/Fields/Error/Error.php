<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Error;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Error\ErrorProps;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Error implements _\ComponentInterface
{
    private function __construct(
        private ErrorProps $error,
    ) {
    }

    public static function create(
        ErrorProps $error,
    ): self {
        return new self(
            error: $error,
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<p data-custom-error class="papertiger-error">' . _\Util::escapeText($this->error->message) . '</p>';
    }
}
