<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\FormBuilder;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Sitegeist\PaperTiger\CPX\NodeTypes\Form\FormFactory;
use Vendor\Shared\Components\Block\FormBuilder\FormBuilder as FormBuilderComponent;
use Vendor\Site\Integration\ContentContainerFactory;
use Vendor\Site\NodeTypes\Document\Document;
use Vendor\Site\NodeTypes\Document\HomePage\HomePage;

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
