<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Command;

use Neos\ContentRepository\Core\DimensionSpace\OriginDimensionSpacePoint;
use Neos\ContentRepository\Core\Feature\NodeCreation\Command\CreateNodeAggregateWithNode;
use Neos\ContentRepository\Core\Feature\NodeModification\Dto\PropertyValuesToWrite;
use Neos\ContentRepository\Core\Feature\RootNodeCreation\Command\CreateRootNodeAggregateWithNode;
use Neos\ContentRepository\Core\Feature\WorkspaceCreation\Command\CreateRootWorkspace;
use Neos\ContentRepository\Core\SharedModel\ContentRepository\ContentRepositoryId;
use Neos\ContentRepository\Core\SharedModel\Node\NodeAggregateId;
use Neos\ContentRepository\Core\SharedModel\Node\NodeName;
use Neos\ContentRepository\Core\SharedModel\Workspace\ContentStreamId;
use Neos\ContentRepository\Core\SharedModel\Workspace\WorkspaceName;
use Neos\ContentRepositoryRegistry\ContentRepositoryRegistry;
use Neos\Flow\Cli\CommandController;
use Neos\Neos\Domain\Model\Domain;
use Neos\Neos\Domain\Model\Site;
use Neos\Neos\Domain\Model\WorkspaceRole;
use Neos\Neos\Domain\Model\WorkspaceRoleAssignment;
use Neos\Neos\Domain\Model\WorkspaceRoleSubject;
use Neos\Neos\Domain\Repository\DomainRepository;
use Neos\Neos\Domain\Repository\SiteRepository;
use Neos\Neos\Domain\Service\NodeTypeNameFactory;
use Neos\Neos\Domain\Service\WorkspaceService;
use PackageFactory\OPGM\Infrastructure\NodeTypeNameExtractor;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

final class ProjectCommandController extends CommandController
{
    public function __construct(
        /** @phpstan-ignore property.onlyWritten (seal will be removed before flight) */
        private readonly ContentRepositoryRegistry $contentRepositoryRegistry,
        /** @phpstan-ignore property.onlyWritten (seal will be removed before flight) */
        private readonly SiteRepository $siteRepository,
        /** @phpstan-ignore property.onlyWritten (seal will be removed before flight) */
        private readonly DomainRepository $domainRepository,
        /** @phpstan-ignore property.onlyWritten (seal will be removed before flight) */
        private readonly WorkspaceService $workspaceService,
    ) {
        parent::__construct();
    }

    public function setupSiteCommand(string $siteName, string $siteId, string $domainName): void
    {
        throw new \RuntimeException(
            'Remove before flight: Make sure to set up the dimension space first'
                . ' and define your node ids and names below'
        );
        /** @phpstan-ignore deadCode.unreachable (seal will be removed before flight) */
        $sitesId = 'vendor-wheelinventor-sites';
        $sitePackageKey = 'Vendor.WheelInventor';
        $initialOriginDSP = OriginDimensionSpacePoint::createWithoutDimensions();
        $contentRepositoryId = ContentRepositoryId::fromString('default');

        $contentRepository = $this->contentRepositoryRegistry->get($contentRepositoryId);

        try {
            $contentRepository->handle(CreateRootWorkspace::create(
                WorkspaceName::forLive(),
                ContentStreamId::create(),
            ));
        } catch (\Throwable $e) {
            // then don't
        }

        try {
            $contentRepository->handle(CreateRootNodeAggregateWithNode::create(
                WorkspaceName::forLive(),
                NodeAggregateId::fromString($sitesId),
                NodeTypeNameFactory::forSites(),
            ));
        } catch (\Throwable $e) {
            // then don't
        }

        try {
            $contentRepository->handle(CreateNodeAggregateWithNode::create(
                workspaceName: WorkspaceName::forLive(),
                nodeAggregateId: NodeAggregateId::fromString($siteId),
                nodeTypeName: NodeTypeNameExtractor::requireFromFQN(HomePage::class),
                originDimensionSpacePoint: $initialOriginDSP,
                parentNodeAggregateId: NodeAggregateId::fromString($sitesId),
                initialPropertyValues: PropertyValuesToWrite::fromArray([
                    'title' => 'Home',
                    'uriPathSegment' => '',
                ])
            )->withNodeName(NodeName::fromString($siteId)));
        } catch (\Throwable $e) {
            // then don't
        }

        $site = $this->siteRepository->findOneByNodeName($siteId);
        if ($site === null) {
            $site = new Site($siteId);
            $site->setName($siteName);
            $site->setSiteResourcesPackageKey($sitePackageKey);
            $site->setState(Site::STATE_ONLINE);
            $this->siteRepository->add($site);
        }

        $domain = $this->domainRepository->findOneByHost($domainName);
        if ($domain === null) {
            $domain = new Domain();
            $domain->setHostname($domainName);
            $domain->setSite($site);
            $this->domainRepository->add($domain);
        }

        try {
            $this->workspaceService->assignWorkspaceRole(
                $contentRepositoryId,
                WorkspaceName::forLive(),
                WorkspaceRoleAssignment::create(
                    WorkspaceRoleSubject::createForGroup('Neos.Flow:Everybody'),
                    WorkspaceRole::VIEWER,
                )
            );
        } catch (\Throwable) {
            // then don't
        }
    }
}
