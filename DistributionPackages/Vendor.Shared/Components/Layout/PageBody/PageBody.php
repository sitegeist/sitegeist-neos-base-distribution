<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Layout\PageBody;

use PackageFactory\ComponentEngine as _;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class PageBody implements _\ComponentInterface
{
    private function __construct(
        private ?_\ComponentInterface $content,
    ) {
    }

    public static function create(
        _\ComponentInterface|string|null $content,
    ): self {
        return new self(
            content: is_string($content) ? _\StringComponent::fromString($content) : $content,
        );
    }

    public function render(): string
    {
        return '<body><header>Header <nav>Navigation</nav></header><main>' . (($temp = $this->content) === null ? '' : $temp->render()) . '</main><footer>footer</footer></body>';
    }
}
