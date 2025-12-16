<?php

declare(strict_types=1);

namespace Vendor\Shared\Application;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
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
    public function getData(?Node $node = null, array $arguments = []): array
    {
        $options = [];
        foreach ($this->assetCollectionRepository->findAll() as $assetCollection) {
            /** @var AssetCollection $assetCollection */
            /** @var string $assetCollectionId */
            $assetCollectionId = $this->persistenceManager->getIdentifierByObject($assetCollection);
            $options[$assetCollectionId]['label']
                = $assetCollection->getTitle();
        }

        return $options;
    }
}
