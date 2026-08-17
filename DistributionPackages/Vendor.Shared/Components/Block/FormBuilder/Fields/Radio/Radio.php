<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Radio;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\RadioItem\RadioItemProps;
use Vendor\Shared\Components\Block\Icon\Icon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Radio implements _\ComponentInterface
{
    private function __construct(
        private RadioItemProps $option,
        private Icon $_2312_Icon,
    ) {
    }

    public static function create(
        RadioItemProps $option,
    ): self {
        return new self(
            option: $option,
            _2312_Icon: Icon::create(
                icon: 'dot-circle',
                class: 'papertiger-radio-item__check',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<label class="papertiger-radio-item"><input type="radio" name="' . _\Util::escapeAttributeValue($this->option->name) . '" value="' . _\Util::escapeAttributeValue($this->option->value) . '"' . ((($temp = $this->option->isChecked) === null) ? '' : ($temp ? ' checked' : '')) . ((($temp = $this->option->isRequired) === null) ? '' : ($temp ? ' required' : '')) . ' class="papertiger-radio-item__input" data-fieldtype="input"' . (((($temp = $this->option->customErrorMessageEnabled) === null) ? false : $temp) ? ((($temp = $this->option->customErrorMessage) === null) ? '' : ' data-custom-error-message="' . _\Util::escapeAttributeValue($temp) . '"') : '') . ' oninvalid="this.setCustomValidity(this.dataset.customErrorMessage || \'\')" oninput="this.setCustomValidity(\'\')" /><span class="papertiger-radio-item__label">' . _\Util::escapeText($this->option->label) . '</span>' . $this->_2312_Icon->render() . '</label>';
    }
}
