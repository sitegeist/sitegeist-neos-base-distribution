<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\Flow\Annotations as Flow;
use PackageFactory\Neos\ComponentEngine\Integration\NeosStuffFactory;
use PackageFactory\Neos\ComponentEngine\NeosAccessInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\ComponentEngine\ComponentList;
use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\Seo\Application\SeoMetaTags\SeoMetaTagsFactory;
use PackageFactory\Neos\Seo\Application\SeoMetaTags\StandardTitle;
use PackageFactory\Neos\Seo\Components\JsonLdTag\JsonLdTag;
use PackageFactory\Neos\Seo\Domain\HrefLangLocaleResolver;
use PackageFactory\Neos\Seo\Domain\SiteSeoConfiguration\SiteSeoConfigurationProvider;
use Psr\Http\Message\UriInterface;

class BaseFactory
{
    public function __construct(
        private readonly NeosStuffFactory $neosStuffFactory,
        #[Flow\InjectConfiguration(path: 'headerComment', package: 'Neos.Neos')]
        protected string $headerComment,
        private readonly HrefLangLocaleResolver $hrefLangLocaleResolver,
        private readonly SiteSeoConfigurationProvider $siteSeoConfigurationProvider,
        private readonly SeoMetaTagsFactory $seoMetaTagsFactory,
    ) {
    }

    /**
     * @param list<JsonLdTag> $additionalStructuredData
     */
    public function createWithContent(
        NeosContext $context,
        ComponentInterface $content,
        array $additionalStructuredData = [],
    ): Base {
        $searchEngineDirectivesConfiguration = $this->siteSeoConfigurationProvider
            ->readFromConfigurationForSiteNode($context->siteNode)
            ->searchEngineDirectivesConfiguration;

        $locale = $this->hrefLangLocaleResolver->tryResolveLocale(
            $context->subgraph->getDimensionSpacePoint(),
            $searchEngineDirectivesConfiguration,
        ) ?: $this->hrefLangLocaleResolver->tryResolveDefaultLocale($searchEngineDirectivesConfiguration);

        return Base::create(
            comment: $this->headerComment,
            language: $locale?->toTagValue() ?: '',
            seoMetaTags: $this->seoMetaTagsFactory->create(
                context: $context,
                title: StandardTitle::createDefault(),
                additionalStructuredData: $additionalStructuredData,
            ),
            content: $content,
            headMetaData: ComponentList::list(
                $this->neosStuffFactory->tryGetHeadStuff($context),
                HtmlResourceFactory::stylesheet(
                    $this->resourceUriWithCacheBuster('Vendor.Shared', 'Build/Styles/main.min.css', $context->neos)
                ),
                HtmlResourceFactory::script(
                    $this->resourceUriWithCacheBuster('Vendor.Shared', 'Build/JavaScript/main.min.js', $context->neos),
                    ['crossorigin' => 'anonymous']
                ),
            ),
            bodyMetaData: $this->neosStuffFactory->tryGetBodyStuff($context->renderingMode->isEdit),
        );
    }

    private function resourceUriWithCacheBuster(
        string $packageKey,
        string $relativePathAndFilename,
        NeosAccessInterface $neosAccess,
    ): UriInterface {
        $uri = $neosAccess->getStaticResourceUri($packageKey, $relativePathAndFilename);
        $resourcePath = 'resource://' . $packageKey . '/Public/Resources/' . $relativePathAndFilename;

        if (file_exists($resourcePath) && !is_dir($resourcePath) && ($fileHash = sha1_file($resourcePath)) !== false) {
            return $uri->withQuery('bust=' . substr($fileHash, 0, 8));
        }

        return $uri;
    }
}
