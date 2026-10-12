<?php

declare(strict_types=1);

namespace Vendor\Site\Infrastructure;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\Core\Cache\ContentCache;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Model\Document;

/**
 * The asset content cache manager infrastructure service
 */
#[Flow\Scope('singleton')]
final class AssetContentCacheManager
{
    public function __construct(
        private readonly ContentCache $contentCache
    ) {
    }

    public function whenAssetWasUpdated(AssetInterface $asset): void
    {
        if ($asset instanceof Document) {
            $this->contentCache->flushByTag('Vendor.Site:Asset');
        }
    }
}
