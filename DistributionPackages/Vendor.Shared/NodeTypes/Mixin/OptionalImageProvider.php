<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;

#[InspectorGroupDeclaration(
    name: 'image',
    label: 'Bild',
    icon: 'image',
    position: 'after document',
)]
#[NodeTypeDeclaration]
interface OptionalImageProvider
{
    public ?ImageSourceProxy $image {get;}
}
