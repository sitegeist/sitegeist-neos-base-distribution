<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\FieldContainer;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\FieldContainer\FieldContainerProps;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class FieldContainer implements _\ComponentInterface
{
    private function __construct(
        private FieldContainerProps $fieldContainer,
        private ?_\ComponentInterface $label,
        private ?_\ComponentInterface $content,
        private ?_\ComponentInterface $error,
    ) {
    }

    public static function create(
        FieldContainerProps $fieldContainer,
        _\ComponentInterface|string|null $label,
        _\ComponentInterface|string|null $content,
        _\ComponentInterface|string|null $error,
    ): self {
        return new self(
            fieldContainer: $fieldContainer,
            label: is_string($label) ? _\StringComponent::fromString($label) : $label,
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
            error: is_string($error) ? _\StringComponent::fromString($error) : $error,
        );
    }

    public function render(): string
    {
        return '<div' . (($temp = $this->fieldContainer->id) === null ? '' : ' id="' . _\Util::escapeAttributeValue($temp) . '"') . '' . ($this->fieldContainer->hasErrors ? ' class="papertiger-field papertiger-field--invalid showInvalid group"' : ' class="papertiger-field group"') . ' data-form-field>' . (($temp = $this->label) === null ? '' : $temp->render()) . '' . (($temp = $this->content) === null ? '' : $temp->render()) . '' . (($temp = $this->error) === null ? '' : $temp->render()) . '</div>';
    }
}
