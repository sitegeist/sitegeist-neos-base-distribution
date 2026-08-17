<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Label;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Label\LabelProps;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Label implements _\ComponentInterface
{
    private function __construct(
        private LabelProps $label,
    ) {
    }

    public static function create(
        LabelProps $label,
    ): self {
        return new self(
            label: $label,
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<label' . ((($temp = $this->label->inputId) === null) ? '' : ' for="' . _\Util::escapeAttributeValue($temp) . '"') . ' class="papertiger-field__label" data-custom-label><span class="papertiger-field__label-text">' . ((($temp = $this->label->label) === null) ? '' : _\Util::escapeText($temp)) . '</span>' . (((!((($temp = $this->label->isRequired) === null) ? false : $temp)) && ((($temp = $this->label->label) === null) ? false : true)) ? '<span class="papertiger-field__optional">(optional)</span>' : '') . ((((($temp = $this->label->isRequired) === null) ? false : $temp) && ((($temp = $this->label->label) === null) ? false : true)) ? '<span class="papertiger-field__required">*</span>' : '') . '</label>';
    }
}
