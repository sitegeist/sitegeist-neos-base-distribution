<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Button;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\ButtonField\ButtonFieldProps;
use Vendor\Shared\Components\Block\Icon\Icon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Button implements _\ComponentInterface
{
    private function __construct(
        private ButtonFieldProps $field,
        private Icon $_812_Icon,
    ) {
    }

    public static function create(
        ButtonFieldProps $field,
    ): self {
        return new self(
            field: $field,
            _812_Icon: Icon::create(
                icon: 'spinner',
                class: 'papertiger-field__button-spinner h-20 w-20 mr-8 animate-spin',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<button type="submit" class="papertiger-field__button papertiger-field__button--submit">' . $this->_812_Icon->render() . '<span class="papertiger-field__button-label">' . ((($temp = $this->field->label) === null) ? '' : _\Util::escapeText($temp)) . '</span></button>';
    }
}
