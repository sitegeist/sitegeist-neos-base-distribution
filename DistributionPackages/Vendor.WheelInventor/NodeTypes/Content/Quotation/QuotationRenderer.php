<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Quotation;

use Neos\Media\Domain\Model\ImageInterface;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Quotation\Quotation;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\FigureFactory;

final class QuotationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $image = $context->nodes->getObjectValue(
            $context->node,
            'image',
            ImageInterface::class
        );

        return ContentContainerFactory::create(
            $context,
            Quotation::create(
                figure: $image ? $this->figureFactory->tryForMixin($context) : '',
                content: $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                ),
                spokenByName: $context->neos->getEditable(
                    $context->node,
                    'spokenByCharacter__name',
                    true
                ),
                spokenByJobTitle: $context->neos->getEditable(
                    $context->node,
                    'spokenByCharacter__jobTitle',
                    true
                )
            )
        );
    }
}
