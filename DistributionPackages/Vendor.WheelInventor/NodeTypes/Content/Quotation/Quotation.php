<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Quotation;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\NodeTypes\Mixin\ImageProvider;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\Shared\NodeTypes\Preset\PlainText;
use Vendor\Shared\NodeTypes\Preset\SquareImage;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Zitat',
    icon: 'comment-alt',
)]
#[Flow\Proxy(false)]
final readonly class Quotation implements ImageProvider
{
    use Content;
    use TextMixin;

    public function __construct(
        #[SquareImage]
        public ImageSourceProxy $image,
        #[PlainText]
        public ?string $text,
        #[PlainText]
        #[InlineEditorConfiguration(placeholder: 'Bitte Name eingeben')]
        public ?string $spokenByCharacterName,
        #[PlainText]
        #[InlineEditorConfiguration(placeholder: 'Bitte Jobbezeichnung eingeben')]
        public ?string $spokenByCharacterJobTitle,
    ) {
    }
}
