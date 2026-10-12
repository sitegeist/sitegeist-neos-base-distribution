<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\Upload;

use PackageFactory\ComponentEngine as _;
use Sitegeist\PaperTiger\CPX\Components\Field\UploadField\UploadField;
use Sitegeist\PaperTiger\CPX\Components\Field\UploadField\UploadFieldProps;
use Vendor\Shared\Components\Block\FormBuilder\Fields\InvalidIcon\InvalidIcon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Upload implements _\ComponentInterface
{
    private function __construct(
        private UploadField $_8_30_UploadField,
        private InvalidIcon $_8_59_InvalidIcon,
    ) {
    }

    public static function create(
        UploadFieldProps $field,
    ): self {
        return new self(
            _8_30_UploadField: UploadField::create(
                field: $field,
            ),
            _8_59_InvalidIcon: InvalidIcon::create(),
        );
    }

    #[\Override]
    public function render(): string
    {
        return '<div class="relative">' . $this->_8_30_UploadField->render() . $this->_8_59_InvalidIcon->render() . '</div>';
    }
}
