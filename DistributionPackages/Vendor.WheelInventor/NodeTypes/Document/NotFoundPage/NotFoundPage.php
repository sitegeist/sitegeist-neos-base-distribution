<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Document\NotFoundPage;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\NodeTypes\ContentCollection;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeConstraintsDeclaration;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\Domain\NodeType\TetheredChildRelationDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\TextFieldEditor\TextFieldEditorConfiguration;
use Vendor\WheelInventor\NodeTypes\Content\Image\Image;
use Vendor\WheelInventor\NodeTypes\Content\ImageWithText\ImageWithText;
use Vendor\WheelInventor\NodeTypes\Content\Text\Text;
use Vendor\WheelInventor\NodeTypes\Document\Document;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: '404 - Not Found',
    icon: 'exclamation-triangle',
)]
#[Flow\Proxy(false)]
final readonly class NotFoundPage extends Document
{
    public function __construct(
        #[TetheredChildRelationDeclaration(
            fqn: ContentCollection::class,
            constraints: new NodeTypeConstraintsDeclaration(fqns: [
                Image::class => true,
                ImageWithText::class => true,
                Text::class => true,
            ]),
        )]
        // @todo: custom content collection type?
        public Node $main,
        public string $title = '404',
        #[TextFieldEditorConfiguration(disabled: true)]
        public string $uriPathSegment = '404',
    ) {
    }
}
