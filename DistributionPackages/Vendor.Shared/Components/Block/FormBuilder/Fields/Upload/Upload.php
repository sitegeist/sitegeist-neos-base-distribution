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
        private UploadField $_830_UploadField,
        private InvalidIcon $_859_InvalidIcon,
    ) {
    }

    public static function create(
        UploadFieldProps $field,
    ): self {
        return new self(
            _830_UploadField: UploadField::create(
                field: $field,
            ),
            _859_InvalidIcon: InvalidIcon::create(),
        );
    }

    public function render(): string
    {
        return '<div class="relative">' . $this->_830_UploadField->render() . '' . $this->_859_InvalidIcon->render() . '</div>';
    }
}
