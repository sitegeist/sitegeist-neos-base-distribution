<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Textarea;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\TextareaField\TextareaField;
use Sitegeist\PaperTiger\CPX\Components\Field\TextareaField\TextareaFieldProps;
use Vendor\Shared\Components\Block\FormBuilder\Fields\InvalidIcon\InvalidIcon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Textarea implements _\ComponentInterface
{
    private function __construct(
        private TextareaField $_8_30_TextareaField,
        private InvalidIcon $_8_61_InvalidIcon,
    ) {
    }

    public static function create(
        TextareaFieldProps $field,
    ): self {
        return new self(
            _8_30_TextareaField: TextareaField::create(
                field: $field,
            ),
            _8_61_InvalidIcon: InvalidIcon::create(),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<div class="relative">' . $this->_8_30_TextareaField->render() . $this->_8_61_InvalidIcon->render() . '</div>';
    }
}
