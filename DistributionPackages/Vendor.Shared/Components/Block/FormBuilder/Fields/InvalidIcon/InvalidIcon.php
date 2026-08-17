<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\FormBuilder\Fields\InvalidIcon;

use PackageFactory\ComponentEngine as _;
use Vendor\Shared\Components\Block\Icon\Icon;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class InvalidIcon implements _\ComponentInterface
{
    private function __construct(
        private Icon $_48_Icon,
    ) {
    }

    public static function create(): self
    {
        return new self(
            _48_Icon: Icon::create(
                icon: 'alert',
                class: 'papertiger-field__invalid-icon',
            ),
        );
    }

    #[\Override]
    public function render(): string
    {
        return $this->_48_Icon->render();
    }
}
