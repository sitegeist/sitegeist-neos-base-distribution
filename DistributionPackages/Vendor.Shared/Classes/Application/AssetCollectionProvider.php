<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Application;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Media\Domain\Model\AssetCollection;
use Neos\Media\Domain\Repository\AssetCollectionRepository;
use Neos\Neos\Service\DataSource\DataSourceInterface;

final class AssetCollectionProvider implements DataSourceInterface
{
    public function __construct(
        private readonly AssetCollectionRepository $assetCollectionRepository,
        private readonly PersistenceManagerInterface $persistenceManager
    ) {
    }

    public static function getIdentifier(): string
    {
        return 'vendor-shared-assetcollections';
    }

    /**
     * @param array<string,mixed> $arguments
     * @return array<string|int,mixed>
     */
    public function getData(NodeInterface $node = null, array $arguments = []): array
    {
        $options = [];
        foreach ($this->assetCollectionRepository->findAll() as $assetCollection) {
            /** @var AssetCollection $assetCollection */
            $options[$this->persistenceManager->getIdentifierByObject($assetCollection)]['label']
                = $assetCollection->getTitle();
        }

        return $options;
    }
}
