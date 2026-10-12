<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Input;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\InputField\InputField;
use Sitegeist\PaperTiger\CPX\Components\Field\InputField\InputFieldProps;
use Vendor\Shared\Components\Block\FormBuilder\Fields\InvalidIcon\InvalidIcon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Input implements _\ComponentInterface
{
    private function __construct(
        private InputField $_8_30_InputField,
        private InvalidIcon $_8_58_InvalidIcon,
    ) {
    }

    public static function create(
        InputFieldProps $field,
    ): self {
        return new self(
            _8_30_InputField: InputField::create(
                field: $field,
            ),
            _8_58_InvalidIcon: InvalidIcon::create(),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<div class="relative">' . $this->_8_30_InputField->render() . $this->_8_58_InvalidIcon->render() . '</div>';
    }
}
