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
        private UploadField $_912_UploadField,
        private InvalidIcon $_1012_InvalidIcon,
    ) {
    }

    public static function create(
        UploadFieldProps $field,
    ): self {
        return new self(
            _912_UploadField: UploadField::create(
                field: $field,
            ),
            _1012_InvalidIcon: InvalidIcon::create(),
        );
    }

    public function render(): string
    {
        return '<div class="relative">' . $this->_912_UploadField->render() . '' . $this->_1012_InvalidIcon->render() . '</div>';
    }
}
