<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Select;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\SelectField\SelectField;
use Sitegeist\PaperTiger\CPX\Components\Field\SelectField\SelectFieldProps;
use Vendor\Shared\Components\Block\FormBuilder\Fields\InvalidIcon\InvalidIcon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Select implements _\ComponentInterface
{
    private function __construct(
        private SelectField $_1012_SelectField,
        private InvalidIcon $_1112_InvalidIcon,
    ) {
    }

    public static function create(
        SelectFieldProps $field,
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            _1012_SelectField: SelectField::create(
                field: $field,
                content: _\SlotComponent::list(
                    (($temp = $content) === null ? null : $temp)
                ),
            ),
            _1112_InvalidIcon: InvalidIcon::create(),
        );
    }

    public function render(): string
    {
        return '<div class="relative">' . $this->_1012_SelectField->render() . '' . $this->_1112_InvalidIcon->render() . '</div>';
    }
}
