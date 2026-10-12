<?php

declare(strict_types=1);

namespace Vendor\Shared\PaperTiger;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\Service\HtmlAugmenter;
use PackageFactory\ComponentEngine\ComponentInterface;

/**
 * Adds the field width to the root element of a rendered PaperTiger field container
 */
#[Flow\Proxy(false)]
final readonly class FieldWidthComponent implements ComponentInterface
{
    public function __construct(
        private ComponentInterface $field,
        private FieldWidth $width,
    ) {
    }

    #[\Override]
    public function render(): string
    {
        return (new HtmlAugmenter())->addAttributes(
            $this->field->render(),
            ['data-field-width' => $this->width->value],
        );
    }
}
