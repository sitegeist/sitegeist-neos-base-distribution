<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\FormBuilder;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Sitegeist\PaperTiger\CPX\NodeTypes\Form\Form;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Form Builder',
    icon: 'wpforms',
)]
#[Flow\Proxy(false)]
final readonly class FormBuilder extends Form implements HeadlineMixin
{
    use HeadlineProperties;

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return $this->headline->value;
    }
}
