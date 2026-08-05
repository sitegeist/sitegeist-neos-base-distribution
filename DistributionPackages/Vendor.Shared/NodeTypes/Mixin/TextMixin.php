<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use Vendor\Shared\NodeTypes\EditableText;
use Vendor\Shared\NodeTypes\Preset\RichText;

#[NodeTypeDeclaration]
interface TextMixin
{
    #[RichText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Text eingeben')]
    public EditableText $text {get;}
}
