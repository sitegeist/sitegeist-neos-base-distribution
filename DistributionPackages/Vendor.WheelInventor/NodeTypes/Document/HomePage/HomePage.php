<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document\HomePage;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\Content;
use Neos\Neos\NodeTypes\ContentCollection;
use Neos\Neos\NodeTypes\Site;
use Neos\Neos\NodeTypes\SiteProperties;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\GoogleSiteVerificationProperties;
use PackageFactory\Neos\Seo\NodeTypes\Mixin\GoogleSiteVerificationProvider;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\Domain\NodeType\TetheredChildRelationDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\FooterMixin;
use Vendor\Shared\NodeTypes\Mixin\FooterProperties;
use Vendor\Shared\NodeTypes\Mixin\SocialMixin;
use Vendor\Shared\NodeTypes\Mixin\SocialProperties;
use Vendor\WheelInventor\NodeTypes\Content\Accordion\Accordion;
use Vendor\WheelInventor\NodeTypes\Content\AnchorNavigation\AnchorNavigation;
use Vendor\WheelInventor\NodeTypes\Content\CollectionBasedDownloads\CollectionBasedDownloads;
use Vendor\WheelInventor\NodeTypes\Content\FormBuilder\FormBuilder;
use Vendor\WheelInventor\NodeTypes\Content\Image\Image;
use Vendor\WheelInventor\NodeTypes\Content\ImageWithText\ImageWithText;
use Vendor\WheelInventor\NodeTypes\Content\ManualDownloads\ManualDownloads;
use Vendor\WheelInventor\NodeTypes\Content\Quotation\Quotation;
use Vendor\WheelInventor\NodeTypes\Content\ReactExample\ReactExample;
use Vendor\WheelInventor\NodeTypes\Content\ReactExampleSSR\ReactExampleSSR;
use Vendor\WheelInventor\NodeTypes\Content\Text\Text;
use Vendor\WheelInventor\NodeTypes\Content\TileNavigation\TileNavigation;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\Shortcut;
use Vendor\WheelInventor\NodeTypes\Document\WebPage\WebPage;

#[NodeTypeDeclaration(
    constraints: new NodeTypeConstraintsDeclaration(
        fqns: [
            WebPage::class => true,
            Shortcut::class => true,
        ],
    ),
)]
#[NodeTypeUiConfiguration(
    label: 'Homepage',
    icon: 'globe',
)]
#[Flow\Proxy(false)]
final readonly class HomePage extends Document implements
    Site,
    GoogleSiteVerificationProvider,
    SocialMixin,
    FooterMixin
{
    use SiteProperties;
    use GoogleSiteVerificationProperties;
    use SocialProperties;
    use FooterProperties;

    public function __construct(
        #[TetheredChildRelationDeclaration(
            fqn: ContentCollection::class,
            constraints: new NodeTypeConstraintsDeclaration(fqns: [
                Content::class => false,
                ManualDownloads::class => true,
                CollectionBasedDownloads::class => true,
                Image::class => true,
                ImageWithText::class => true,
                Quotation::class => true,
                Text::class => true,
                Accordion::class => true,
                TileNavigation::class => true,
                AnchorNavigation::class => true,
                ReactExample::class => true,
                ReactExampleSSR::class => true,
                FormBuilder::class => true,
            ]),
        )]
        // @todo: custom content collection type?
        public Node $main,
    ) {
    }
}
