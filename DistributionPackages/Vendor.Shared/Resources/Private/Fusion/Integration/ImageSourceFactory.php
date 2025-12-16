<?php

declare(strict_types=1);

namespace Vendor\Shared\Integration;

use Neos\ContentRepository\Core\NodeType\NodeType;
use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\Document;
use Neos\Media\Domain\Model\ImageInterface;
use Neos\Media\Domain\Model\ImageVariant;
use Neos\Media\Domain\Service\ThumbnailService;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use Sitegeist\Kaleidoscope\Domain\AssetImageSource;
use Sitegeist\Kaleidoscope\Domain\DummyImageSource;
use Sitegeist\Kaleidoscope\Domain\ImageSourceInterface;
use Sitegeist\Kaleidoscope\Domain\UriImageSource;

final class ImageSourceFactory extends AbstractComponentPresentationObjectFactory
{
    #[Flow\Inject]
    protected ThumbnailService $thumbnailService;

    public function tryFromImageMixin(
        Node $imageMixin,
        bool $fallbackToDummyImage,
        ?string $alternateText = null
    ): ?ImageSourceInterface {
        $image = $imageMixin->getProperty('image');
        if ($image instanceof ImageInterface) {
            return $this->forImage(
                $image,
                self::getStringValue($imageMixin, 'image__alt') ?: '',
                self::getStringValue($imageMixin, 'image__title') ?: ''
            );
        } elseif ($fallbackToDummyImage) {
            $nodeType = $this->getNodeType($imageMixin);
            return $nodeType
                ? self::createDummyImage(
                    $nodeType,
                    (string)$this->uriService->getDummyImageBaseUri(),
                    'image',
                    $alternateText
                )
                : null;
        }

        return null;
    }

    public function tryFromImageMixinForProperty(
        Node $imageMixin,
        string $propertyName,
        bool $fallbackToDummyImage,
        ?string $alternateText = null,
        bool $useOriginalImage = false
    ): ?ImageSourceInterface {
        $image = $imageMixin->getProperty($propertyName);
        if ($image instanceof ImageInterface) {
            if ($useOriginalImage && $image instanceof ImageVariant) {
                $image = $image->getOriginalAsset();
            }
            return $this->forImage(
                $image,
                self::getStringValue($imageMixin, $propertyName . '__alt') ?: '',
                self::getStringValue($imageMixin, $propertyName . '__title') ?: '',
            );
        } elseif ($fallbackToDummyImage) {
            $nodeType = $this->getNodeType($imageMixin);
            return $nodeType
                ? self::createDummyImage(
                    $nodeType,
                    (string)$this->uriService->getDummyImageBaseUri(),
                    'image',
                    $alternateText
                )
                : null;
        }

        return null;
    }

    public function forImage(ImageInterface $image, string $alt, string $title): ?ImageSourceInterface
    {
        if ($image->getResource()->getMediaType() === 'image/svg+xml') {
            $uri = $this->uriService->getPersistentResourceUri($image->getResource());
            return $uri ?
                new UriImageSource(
                    (string)$uri,
                    $alt,
                    $title
                )
                : null;
        }

        return new AssetImageSource(
            $image,
            $title,
            $alt,
            true,
            $this->uriService->getControllerContext()->getRequest()
        );
    }

    public function tryForDocument(
        Document $document,
        ?string $alt = null,
        ?string $title = null
    ): ?ImageSourceInterface {
        try {
            $thumbnail = $this->thumbnailService->getThumbnail(
                $document,
                $this->thumbnailService->getThumbnailConfigurationForPreset('pdf')
            );
        } catch (\Exception $e) {
            $thumbnail = null;
        }
        return $thumbnail
            ? new UriImageSource(
                $this->thumbnailService->getUriForThumbnail($thumbnail),
                $title ?: $document->getTitle(),
                $alt ?: $document->getCaption()
            )
            : null;
    }

    public static function createDummyImage(
        NodeType $nodeType,
        string $baseUri,
        string $propertyName = 'image',
        ?string $text = null
    ): DummyImageSource {
        switch ($nodeType->getConfiguration(
            'properties.' . $propertyName . '.ui.inspector.editorOptions.crop.aspectRatio.locked'
        )) {
            case ['width' => 1, 'height' => 1]:
                $width = 1080;
                $height = 1080;
                break;
            case ['width' => 3, 'height' => 1]:
                $width = 1920;
                $height = 640;
                break;
            case ['width' => 3, 'height' => 4]:
                $width = 900;
                $height = 1200;
                break;
            case ['width' => 4, 'height' => 3]:
                $width = 1200;
                $height = 900;
                break;
            case ['width' => 16, 'height' => 9]:
            case null:
            default:
                $width = 1920;
                $height = 1080;
        }

        return new DummyImageSource(
            $baseUri,
            null,
            null,
            $width,
            $height,
            null,
            null,
            $text
        );
    }
}
