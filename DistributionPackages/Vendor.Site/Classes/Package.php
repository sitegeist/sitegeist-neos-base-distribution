<?php

declare(strict_types=1);

namespace Vendor\Site;

use Neos\Flow\Core\Booting\Sequence;
use Neos\Flow\Core\Booting\Step;
use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Package\Package as BasePackage;
use Neos\Media\Domain\Service\AssetService;
use Vendor\Site\Infrastructure\AssetContentCacheManager;

class Package extends BasePackage
{
    public function boot(Bootstrap $bootstrap): void
    {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();
        $package = $this;
        $dispatcher->connect(
            Sequence::class,
            'afterInvokeStep',
            function (Step $step) use ($package, $bootstrap) {
                if ($step->getIdentifier() === 'neos.flow:objectmanagement:runtime') {
                    $package->registerAssetCacheSlots($bootstrap);
                }
            }
        );
    }

    public function registerAssetCacheSlots(Bootstrap $bootstrap): void
    {
        $bootstrap->getSignalSlotDispatcher()->connect(
            AssetService::class,
            'assetUpdated',
            AssetContentCacheManager::class,
            'whenAssetWasUpdated'
        );
    }
}
