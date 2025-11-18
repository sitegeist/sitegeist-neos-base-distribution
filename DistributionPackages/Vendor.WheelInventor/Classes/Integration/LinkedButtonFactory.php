<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Integration\LinkFactory;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;

final class LinkedButtonFactory
{
    public function __construct(
        private readonly LinkFactory $linkFactory,
    ) {
    }

    public function tryForLinkMixin(Node $node, ContentSubgraphInterface $subgraph, bool $inBackend): ?SlotInterface
    {
        $link = $node->getProperty('link');
        $linkLabel = $node->getProperty('link__label');

        $button = new Button(
            ButtonVariant::VARIANT_SOLID,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString($linkLabel ?: ''),
            Icon::specifiedWith(
                IconName::NAME_ARROW_RIGHT,
                IconSize::SIZE_REGULAR,
                IconColor::COLOR_DEFAULT
            ),
            $inBackend
        );

        $linkComponent = null;
        if (!$inBackend) {
            $linkComponent = $this->linkFactory->tryForLinkPropertyValues($link, $linkLabel, $subgraph, $button);
        }

        return $linkComponent ?: $button;
    }
}
