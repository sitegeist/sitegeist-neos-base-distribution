<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Media\Domain\Model\ImageInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Figure\Figure;

final class FigureFactory
{
    public function tryForMixin(
        NeosContext $context,
        string $propertyName = 'image',
        ?Node $node = null
    ): Figure {
        $sourceNode = $node ?? $context->node;
        $image = $context->nodes->getObjectValue(
            $sourceNode,
            $propertyName,
            ImageInterface::class
        );

        if (!$image) {
            return Figure::create(
                src: null,
                alt: null,
                title: null,
                class: null
            );
        }

        return Figure::create(
            src: (string)$context->neos->getPersistentResourceUri($image->getResource()),
            alt: $context->nodes->getStringValue($sourceNode, $propertyName . '__alt'),
            title: $context->nodes->getStringValue($sourceNode, $propertyName . '__title'),
            class: null
        );
    }
}
