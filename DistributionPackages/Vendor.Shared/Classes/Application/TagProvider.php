<?php

/*
 * This file is part of the EulerHermes.Archive package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Application;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Media\Domain\Model\Tag;
use Neos\Media\Domain\Repository\TagRepository;
use Neos\Neos\Service\DataSource\DataSourceInterface;

final class TagProvider implements DataSourceInterface
{
    public function __construct(
        private readonly TagRepository $tagRepository,
        private readonly PersistenceManagerInterface $persistenceManager
    ) {
    }

    public static function getIdentifier(): string
    {
        return 'vendor-shared-tags';
    }

    /**
     * @param array<string,mixed> $arguments
     * @return array<string|int,mixed>
     */
    public function getData(NodeInterface $node = null, array $arguments = []): array
    {
        $options = [];
        foreach ($this->tagRepository->findAll() as $tag) {
            /** @var Tag $tag */
            $options[$this->persistenceManager->getIdentifierByObject($tag)]['label']
                = $tag->getLabel();
        }

        return $options;
    }
}
