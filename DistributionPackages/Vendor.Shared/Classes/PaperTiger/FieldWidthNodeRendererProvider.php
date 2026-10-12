<?php

declare(strict_types=1);

namespace Vendor\Shared\PaperTiger;

use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\NodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\Integration\NodeRendererProviderInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;

/**
 * PaperTiger renders its fields itself and the field container component only gets a few
 * props, so the field width is added by decorating the renderers of all form fields.
 * Every other node keeps the renderer of the wrapped provider (see Objects.yaml).
 */
#[Flow\Scope('singleton')]
final class FieldWidthNodeRendererProvider implements NodeRendererProviderInterface
{
    private const FORM_FIELD_NODE_TYPE = 'Sitegeist.PaperTiger.CPX:Field.FormField';

    public function __construct(
        private readonly NodeRendererProviderInterface $nodeRendererProvider,
    ) {
    }

    #[\Override]
    public function provideNodeRenderer(NeosContext $context): NodeRendererInterface
    {
        $nodeRenderer = $this->nodeRendererProvider->provideNodeRenderer($context);

        $isFormField = $context->nodes->tryGetNodeType($context->node)?->isOfType(self::FORM_FIELD_NODE_TYPE) ?? false;

        return $isFormField && $nodeRenderer instanceof ContentNodeRendererInterface
            ? new FieldWidthRenderer($nodeRenderer)
            : $nodeRenderer;
    }
}
