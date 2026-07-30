<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes;

use Neos\ContentRepository\Core\SharedModel\Node\NodeAddress;
use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\EditableString;
use PackageFactory\OPGM\Domain\Property\NodeBoundPropertyValue;

#[Flow\Proxy(false)]
final readonly class EditableText implements NodeBoundPropertyValue, EditableString
{
    public function __construct(
        public NodeAddress $nodeAddress,
        public string $propertyName,
        public ?string $value,
    ) {
    }

    public static function fromNodeProperty(NodeAddress $nodeAddress, string $propertyName, mixed $rawValue): static
    {
        return new self($nodeAddress, $propertyName, is_string($rawValue) ? $rawValue : null);
    }
}
