<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\FormBuilder;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Sitegeist\PaperTiger\CPX\NodeTypes\Form\FormFactory;
use Vendor\Shared\Components\Block\FormBuilder\FormBuilder;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Neos\Flow\Annotations as Flow;

final class FormBuilderRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context,
            FormBuilder::create(
                $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                $this->formFactory->create($context),
            )
        );
    }
}
