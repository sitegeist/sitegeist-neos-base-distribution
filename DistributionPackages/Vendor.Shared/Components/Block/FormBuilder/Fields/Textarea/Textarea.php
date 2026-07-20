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
        private TextareaField $_912_TextareaField,
        private InvalidIcon $_1012_InvalidIcon,
    ) {
    }

    public static function create(
        TextareaFieldProps $field,
    ): self {
        return new self(
            _912_TextareaField: TextareaField::create(
                field: $field,
            ),
            _1012_InvalidIcon: InvalidIcon::create(),
        );
    }

    public function render(): string
    {
        return '<div class="relative">' . $this->_912_TextareaField->render() . '' . $this->_1012_InvalidIcon->render() . '</div>';
    }
}
