<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\FormBuilder;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Form Builder',
    icon: 'wpforms',
)]
#[Flow\Proxy(false)]
final readonly class FormBuilder implements Content, HeadlineMixin
{
    use ContentProperties;
    use HeadlineProperties;
    /** @todo FormMixin */
}
