<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\DataSource;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Vendor\WheelInventor\Domain\Sailor;

final class AnchorDataSource extends AbstractDataSource
{
    protected static $identifier = 'available-anchors';

    public function __construct(
        private readonly Sailor $sailor,
    ) {
    }

    /**
     * @param array<int,mixed> $arguments
     * @return array<int,mixed>
     */
    public function getData(Node $node = null, array $arguments = [])
    {
        $result = [];

        if ($node) {
            $availableAnchors = $this->sailor->findAvailableNeighbouringAnchors($node);

            foreach ($availableAnchors as $anchorID) {
                $result[] = ['value' => $anchorID, 'label' => $anchorID];
            }
        }
        return $result;
    }
}
