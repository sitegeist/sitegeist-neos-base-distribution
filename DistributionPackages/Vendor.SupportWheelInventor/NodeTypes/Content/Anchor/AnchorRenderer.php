<?php

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\NodeTypes\Content\Anchor;

use GuzzleHttp\Psr7\Uri;
use Neos\ContentRepository\Core\Projection\ContentGraph\ContentSubgraphInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Editable;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Presentation\Layout\ContentContainer\ContentContainerVariant;


final class AnchorRenderer extends AbstractComponentPresentationObjectFactory
{
    public function renderAsContent(
        Node $contentNode,
        Node $documentNode,
        Node $siteNode,
        ContentSubgraphInterface $subgraph,
        bool $inBackend,
    ): SlotInterface
    {
        return new ContentContainer(
            ContentContainerVariant::VARIANT_NONE,
            new Link(
                LinkVariant::VARIANT_REGULAR,
                ArchaeopteryxLink::create(
                    new Uri('#' . $contentNode->getProperty('targetIdentifier')),
                    $contentNode->getProperty('anchorTitle') ?: '',
                    LinkTarget::TARGET_SELF->value,
                    ['noopener', 'nofollow'],
                ),
                new Button(
                    ButtonVariant::VARIANT_PIPE,
                    ButtonType::TYPE_REGULAR,
                    ButtonColor::COLOR_BRAND,
                    Editable::fromNodeProperty($contentNode, 'title'),
                    null,
                    $inBackend
                ),
                $inBackend
            )
        );
    }
}
