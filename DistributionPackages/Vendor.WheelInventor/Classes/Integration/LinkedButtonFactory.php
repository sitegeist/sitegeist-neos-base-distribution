<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Button\Button;
use Vendor\Shared\Components\Block\Button\ButtonTag;
use Vendor\Shared\Components\Block\Button\ButtonVariant;
use Vendor\Shared\Components\Block\LinkedButton\LinkedButton;
use Vendor\Shared\NodeTypes\Mixin\LinkProvider;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkProvider;

final class LinkedButtonFactory
{
    public function tryForLinkProvider(
        LinkProvider|OptionalLinkProvider $linkProvider,
        NeosContext $context,
    ): Button|LinkedButton|null {
        $button = Button::create(
            $context->neos->getEditableFromProperty($linkProvider->linkLabel, true),
            ButtonTag::TAG_SPAN,
            ButtonVariant::VARIANT_REGULAR
        );

        $linkStruct = $linkProvider->link
            ? LinkStructFactory::tryForLink($linkProvider->link, $context->subgraph, $context->neos)
            : null;

        if ($context->renderingMode->isEdit && $linkStruct) {
            return $button;
        }

        $label = $linkProvider->linkLabel->value;
        if (!$label || !$linkStruct) {
            return null;
        }

        return LinkedButton::create(
            $button,
            $linkStruct
        );
    }
}
