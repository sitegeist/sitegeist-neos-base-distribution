<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\Integration;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Flow\Annotations as Flow;
use Neos\Media\Domain\Model\Document;
use Neos\Utility\Files;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Vendor\Shared\Integration\ImageSourceFactory;
use Vendor\Shared\Integration\LinkFactory;
use Vendor\Shared\Presentation\Block\Button\Button;
use Vendor\Shared\Presentation\Block\Button\ButtonColor;
use Vendor\Shared\Presentation\Block\Button\ButtonType;
use Vendor\Shared\Presentation\Block\Button\ButtonVariant;
use Vendor\Shared\Presentation\Block\DownloadCard\DownloadCard;
use Vendor\Shared\Presentation\Block\Figure\Figure;
use Vendor\Shared\Presentation\Block\Figure\FigureAspectRatio;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectFit;
use Vendor\Shared\Presentation\Block\Figure\FigureObjectPosition;
use Vendor\Shared\Presentation\Block\Figure\FigureSize;
use Vendor\Shared\Presentation\Block\Headline\Headline;
use Vendor\Shared\Presentation\Block\Headline\HeadlineType;
use Vendor\Shared\Presentation\Block\Headline\HeadlineVariant;
use Vendor\Shared\Presentation\Block\Icon\Icon;
use Vendor\Shared\Presentation\Block\Icon\IconColor;
use Vendor\Shared\Presentation\Block\Icon\IconName;
use Vendor\Shared\Presentation\Block\Icon\IconSize;

#[Flow\Scope('singleton')]
final class DownloadCardFactory
{
    public function __construct(
        private readonly ImageSourceFactory $imageSourceFactory,
        private readonly LinkFactory $linkFactory,
    ) {
    }

    public function forDownloadNode(Node $downloadNode, bool $inBackend): DownloadCard
    {
        $imageSource = $this->imageSourceFactory->tryFromImageMixin($downloadNode, false);
        $asset = $downloadNode->getProperty('asset');
        $uploadedImage = $imageSource
            ? new Figure(
                $imageSource,
                true,
                FigureSize::SIZE_FIFTH_HALF_FULL,
                FigureObjectFit::FIT_COVER,
                FigureObjectPosition::POSITION_CENTER,
                FigureAspectRatio::RATIO_3X4
            ) : null ;

        return $asset instanceof Document
            ? $this->forAsset(
                $asset,
                $inBackend,
                $uploadedImage
            )
            : new DownloadCard(
                $uploadedImage,
                null,
                null,
                null,
                null,
            );
    }

    public function forAsset(Document $asset, bool $inBackend, ?Figure $customImage): DownloadCard
    {
        $button = new Button(
            ButtonVariant::VARIANT_DOWNLOAD,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString('Download'),
            Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT),
            $inBackend
        );

        return new DownloadCard(
            $customImage ?: $this->getMediaForDocument($asset),
            new Headline(
                HeadlineVariant::VARIANT_REGULAR,
                HeadlineType::TYPE_DIV,
                Value::fromString($asset->getTitle() ?: ''),
            ),
            Value::fromString(strtoupper($asset->getFileExtension())),
            Value::fromString(Files::bytesToSizeString($asset->getResource()->getFileSize())),
            $inBackend ? $button : $this->linkFactory->forAsset($asset, $button)
        );
    }

    private function getMediaForDocument(Document $asset): SlotInterface
    {
        switch ($asset->getFileExtension()) {
            case 'pdf':
                $imageSource = $this->imageSourceFactory->tryForDocument($asset);
                return $imageSource
                    ? new Figure(
                        $imageSource,
                        true,
                        FigureSize::SIZE_FIFTH_HALF_FULL,
                        FigureObjectFit::FIT_COVER,
                        FigureObjectPosition::POSITION_CENTER,
                        FigureAspectRatio::RATIO_1X1
                    )
                    : Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT);
            case 'ppt':
            case 'pptx':
            default:
                return Icon::specifiedWith(
                    IconName::NAME_ARROW_RIGHT,
                    IconSize::SIZE_REGULAR,
                    IconColor::COLOR_DEFAULT
                );
        }
    }
}
