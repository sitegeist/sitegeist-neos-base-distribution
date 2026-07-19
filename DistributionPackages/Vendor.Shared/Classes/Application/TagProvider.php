<?php

declare(strict_types=1);

namespace Vendor\Shared\Application;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
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

    public const string IDENTIFIER = 'vendor-shared-tags';

    public static function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    /**
     * @param array<string,mixed> $arguments
     * @return array<string|int,mixed>
     */
    public function getData(?Node $node = null, array $arguments = []): array
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
