<?php

declare(strict_types=1);

namespace Vendor\Shared\Application;

use Neos\ContentRepository\Core\NodeType\NodeType;
use Neos\ContentRepository\Core\NodeType\NodeTypePostprocessorInterface;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\I18n\Translator;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\Eel\ProtectedContextAwareInterface;
use Vendor\Shared\Domain\Enum\IsEnum;
use Vendor\Shared\Domain\Enum\EnumLabel;

final class EnumProvider extends AbstractDataSource implements
    ProtectedContextAwareInterface,
    NodeTypePostprocessorInterface
{
    #[Flow\Inject]
    protected Translator $translator;

    /**
     * @var string
     */
    protected static $identifier = 'packagefactory-atomicfusion-presentationobjects-enumcases';

    /**
     * @param array<string|int,string> $arguments
     * @return array<string|int,array<string,string>>
     */
    public function getData(?Node $node = null, array $arguments = []): array
    {
        if (!array_key_exists('enumName', $arguments) || !is_string($arguments['enumName'])) {
            throw new \InvalidArgumentException('Argument "enumName" must be provided.', 1625297174);
        }
        /** @var class-string<mixed> $enumName */
        $enumName = $arguments['enumName'];

        $values = $this->getValues($enumName);
        $enumLabel = EnumLabel::fromEnumName($enumName);
        $options = [];
        foreach ($values as $value) {
            $options[$value]['label'] = $enumLabel->translate((string)$value, $this->translator);
        }

        return $options;
    }

    /**
     * @param array<mixed> $configuration
     * @param array<mixed> $options
     */
    public function process(NodeType $nodeType, array &$configuration, array $options): void
    {
        if (!array_key_exists('enumName', $options) || !is_string($options['enumName'])) {
            throw new \InvalidArgumentException('Option "enumName" must be provided.', 1625298032);
        }
        if (!array_key_exists('propertyNames', $options) || !is_array($options['propertyNames'])) {
            throw new \InvalidArgumentException('Option "propertyNames" must be provided.', 1626540931);
        }
        /** @var class-string<mixed> $enumName */
        $enumName = $options['enumName'];
        $values = $this->getValues($enumName);
        $enumLabel = EnumLabel::fromEnumName($enumName);
        foreach ($options['propertyNames'] as $propertyName) {
            foreach ($values as $value) {
                $configuration['properties'][$propertyName]['ui']['inspector']['editorOptions']['values'][$value] = [
                    'label' => $enumLabel->translate((string)$value, $this->translator)
                ];
            }
        }
    }

    /**
     * @param class-string<mixed> $enumName
     * @return array|string[]|int[]
     */
    public function getValues(string $enumName): array
    {
        return array_map(function (\BackedEnum $case) {
            return $case->value;
        }, $this->getCases($enumName));
    }

    /**
     * @param class-string<mixed> $enumName
     * @return array<int,\BackedEnum>
     */
    public function getCases(string $enumName): array
    {
        if (!IsEnum::isSatisfiedByClassName($enumName)) {
            throw new \InvalidArgumentException(
                'Given enum "' . $enumName . '" does not exist or does not implement the required '
                . \BackedEnum::class,
                1625297031
            );
        }

        return $enumName::cases();
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
