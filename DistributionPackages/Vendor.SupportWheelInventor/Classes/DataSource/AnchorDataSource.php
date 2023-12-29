<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\DataSource;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Vendor\SupportWheelInventor\Domain\Sailor;

final class AnchorDataSource extends AbstractDataSource
{
    protected static $identifier = 'available-anchors';

    /**
     * @param array<int,mixed> $arguments
     * @return array<int,mixed>
     */
    public function getData(NodeInterface $node = null, array $arguments = [])
    {
        $result = [];

        if ($node) {
            $availableAnchors = (new Sailor())->findAvailableNeighbouringAnchors($node);

            foreach ($availableAnchors as $anchorID) {
                $result[] = ['value' => $anchorID, 'label' => $anchorID];
            }
        }
        return $result;
    }
}
