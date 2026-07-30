<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\Integration\NeosStuffFactory;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\ComponentEngine\ComponentCollection;
use PackageFactory\ComponentEngine\ComponentInterface;
use Psr\Http\Message\UriInterface;

class BaseFactory
{
    public function __construct(
        private NeosStuffFactory $neosStuffFactory,
        #[Flow\InjectConfiguration(path: 'headerComment', package: 'Neos.Neos')]
        protected string $headerComment
    ) {
    }

    public function createWithContent(NeosContext $context, ComponentInterface $content): Base
    {
        return Base::create(
            comment: $this->headerComment,
            title: $context->documentNode->getProperty('title') ?? '[todo]',
            language: $context->subgraph->getDimensionSpacePoint()->coordinates['language'] ?? '',
            content: $content,
            headMetaData: ComponentCollection::list(
                $this->neosStuffFactory->tryGetHeadStuff($context),
                HtmlResourceFactory::stylesheet(
                    $this->resourceUriWithCacheBuster('Vendor.Shared', 'Build/Styles/main.min.css', $context)
                ),
                HtmlResourceFactory::script(
                    $this->resourceUriWithCacheBuster('Vendor.Shared', 'Build/JavaScript/main.min.js', $context),
                    ['crossorigin' => 'anonymous']
                ),
            ),
            bodyMetaData: $this->neosStuffFactory->tryGetBodyStuff($context->renderingMode->isEdit),
        );
    }

    private function resourceUriWithCacheBuster(
        string $packageKey,
        string $relativePathAndFilename,
        NeosContext $context
    ): UriInterface {
        $uri = $context->neos->getStaticResourceUri($packageKey, $relativePathAndFilename);
        $resourcePath = 'resource://' . $packageKey . '/Public/Resources/' . $relativePathAndFilename;

        if (file_exists($resourcePath) && !is_dir($resourcePath) && ($fileHash = sha1_file($resourcePath)) !== false) {
            return $uri->withQuery('bust=' . substr($fileHash, 0, 8));
        }

        return $uri;
    }
}
