<?php

declare(strict_types=1);

namespace AccordionItem;

use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Collection;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Vendor\Shared\Presentation\Block\AccordionItem\AccordionItem;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;
use Vendor\Shared\Presentation\Block\Text\Text;
use Vendor\Shared\Presentation\Block\Text\TextColumns;
use Vendor\Shared\Presentation\Layout\Stack\Stack;
use Vendor\Shared\Presentation\Layout\Stack\StackVariant;
use Vendor\SupportWheelInventor\Integration\LinkedButtonFactory;

final class AccordionItemRenderer extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
    ) {
    }

    public function renderAsContent(
        Node $contentNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface {
        return new AccordionItem(
            Editable::fromNodeProperty($contentNode, 'headline'),
            new Stack(
                StackVariant::VARIANT_REGULAR,
                Collection::fromSlots(...array_filter([
                    new Text(
                        TextColumns::from(self::getStringValue($contentNode, 'columns') ?: 'oneColumn'),
                        Editable::fromNodeProperty($contentNode, 'text')
                    ),
                    $this->linkedButtonFactory->tryForLinkMixin($contentNode, $subgraph, $inBackend)
                ]))
            ),
            Icon::specifiedWith(
                IconName::NAME_DASH,
                IconSize::SIZE_REGULAR,
                IconColor::COLOR_DEFAULT
            ),
            Icon::specifiedWith(
                IconName::NAME_PLUS,
                IconSize::SIZE_REGULAR,
                IconColor::COLOR_DEFAULT
            ),
            self::getBoolValue($contentNode, 'isAccordionOpen') ?: false,
            $inBackend
        );
    }
}
