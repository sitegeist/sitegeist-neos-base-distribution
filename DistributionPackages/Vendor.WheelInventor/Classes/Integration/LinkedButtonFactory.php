<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Button\ButtonTag;
use Vendor\Shared\Components\Block\Button\ButtonVariant;
use Vendor\Shared\Components\Block\Link\LinkedButton;

final class LinkedButtonFactory
{
    public function __construct(
        private readonly LinkStructFactory $linkStructFactory
    ) {
    }

    public function tryForMixin(
        NeosContext $context,
        ?string $propertyName = 'link'
    ): Button|LinkedButton|null {
        $button = Button::create(
            $context->neos->getEditable(
                $context->node,
                $propertyName . '__label',
                true
            ),
            ButtonTag::TAG_SPAN,
            ButtonVariant::VARIANT_REGULAR
        );

        $linkStruct = $this->linkStructFactory->tryForMixin($context, $propertyName);

        if ($context->renderingMode->isEdit && $linkStruct) {
            return $button;
        }

        $label = $context->nodes->getStringValue($context->node, $propertyName . '__label');
        if (!$label || !$linkStruct) {
            return null;
        }

        return LinkedButton::create(
            $button,
            $linkStruct
        );
    }
}
