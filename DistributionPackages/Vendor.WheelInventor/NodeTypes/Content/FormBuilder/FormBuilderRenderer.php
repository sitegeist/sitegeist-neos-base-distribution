<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\FormBuilder;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Sitegeist\PaperTiger\CPX\NodeTypes\Form\FormFactory;
use Vendor\Shared\Components\Block\FormBuilder\FormBuilder as FormBuilderComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<FormBuilder,Document,HomePage>
 */
final class FormBuilderRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->current,
            FormBuilderComponent::create(
                $context->neos->getEditableFromProperty($context->current->headline, true),
                $this->formFactory->create($context),
            )
        );
    }
}
