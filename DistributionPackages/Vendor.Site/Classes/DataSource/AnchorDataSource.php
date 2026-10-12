<?php

declare(strict_types=1);

namespace Vendor\Site\DataSource;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Vendor\Site\Domain\Sailor;

final class AnchorDataSource extends AbstractDataSource
{
    public const string IDENTIFIER = 'available-anchors';

    protected static $identifier = self::IDENTIFIER;

    public function __construct(
        private readonly Sailor $sailor,
    ) {
    }

    /**
     * @param array<int,mixed> $arguments
     * @return array<int,mixed>
     */
    public function getData(?Node $node = null, array $arguments = [])
    {
        $result = [];

        if ($node) {
            foreach ($this->sailor->findAvailableAnchorLabels($node) as $anchorId => $label) {
                $result[] = ['value' => $anchorId, 'label' => $label];
            }
        }
        return $result;
    }
}
