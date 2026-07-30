<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\FormBuilder;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Sitegeist\PaperTiger\CPX\NodeTypes\Form\FormFactory;
use Vendor\Shared\Components\Block\FormBuilder\FormBuilder as FormBuilderComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;

final class FormBuilderRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $formBuilder = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, FormBuilder::class);

        return ContentContainerFactory::create(
            $context,
            FormBuilderComponent::create(
                $context->neos->getEditableFromProperty($formBuilder->headline, true),
                $this->formFactory->create($context),
            )
        );
    }
}
