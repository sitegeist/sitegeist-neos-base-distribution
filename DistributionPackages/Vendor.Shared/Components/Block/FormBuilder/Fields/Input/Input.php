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
        private InputField $_912_InputField,
        private InvalidIcon $_1012_InvalidIcon,
    ) {
    }

    public static function create(
        InputFieldProps $field,
    ): self {
        return new self(
            _912_InputField: InputField::create(
                field: $field,
            ),
            _1012_InvalidIcon: InvalidIcon::create(),
        );
    }

    public function render(): string
    {
        return '<div class="relative">' . $this->_912_InputField->render() . '' . $this->_1012_InvalidIcon->render() . '</div>';
    }
}
