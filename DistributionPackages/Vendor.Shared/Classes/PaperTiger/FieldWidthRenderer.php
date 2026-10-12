<?php

declare(strict_types=1);

namespace Vendor\Shared\PaperTiger;

use Neos\Flow\Annotations as Flow;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

/**
 * Decorates the renderer of a PaperTiger form field with the field width
 */
#[Flow\Proxy(false)]
final readonly class FieldWidthRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private ContentNodeRendererInterface $fieldRenderer,
    ) {
    }

    #[\Override]
    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $field = $this->fieldRenderer->renderAsContent($context);
        $widthValue = $context->node->getProperty('width');
        $width = is_string($widthValue) ? FieldWidth::tryFrom($widthValue) : null;

        return $width ? new FieldWidthComponent($field, $width) : $field;
    }
}
