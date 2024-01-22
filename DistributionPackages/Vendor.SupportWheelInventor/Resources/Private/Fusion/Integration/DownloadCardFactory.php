<?php

/*
 * This file is part of the Vendor.SupportWheelInventor package.
 */

declare(strict_types=1);

namespace Vendor\SupportWheelInventor\Integration;

use Neos\Flow\Annotations as Flow;
use Neos\ContentRepository\Domain\Model\Node;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Model\Document;
use Neos\Utility\Files;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\AbstractComponentPresentationObjectFactory;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\SlotInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Presentation\Slot\Value;
use Sitegeist\Archaeopteryx\Link as ArchaeopteryxLink;
use Vendor\Shared\Integration\ImageSourceFactory;
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
use Vendor\Shared\Presentation\Block\Link\Link;
use Vendor\Shared\Presentation\Block\Link\LinkTarget;
use Vendor\Shared\Presentation\Block\Link\LinkVariant;

#[Flow\Scope('singleton')]
final class DownloadCardFactory extends AbstractComponentPresentationObjectFactory
{
    public function __construct(
        public readonly ImageSourceFactory $imageSourceFactory,
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

        return $this->forAsset(
            $asset,
            $inBackend,
            $uploadedImage
        );
    }

    public function forAsset(?AssetInterface $asset, bool $inBackend, ?Figure $customImage): DownloadCard
    {
        $assetMedia = ($asset instanceof Document) ? $this->getMediaForDocument($asset) : null;
        $button = new Button(
            ButtonVariant::VARIANT_DOWNLOAD,
            ButtonType::TYPE_REGULAR,
            ButtonColor::COLOR_BRAND,
            Value::fromString('Download'),
            Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT),
            $inBackend
        );

        return new DownloadCard(
            $customImage ?: $assetMedia,
            new Headline(
                HeadlineVariant::VARIANT_REGULAR,
                HeadlineType::TYPE_DIV,
                Value::fromString($asset?->getTitle() ?: ''),
            ),
            ($asset instanceof Document)
                ? Value::fromString(strtoupper($asset->getFileExtension()))
                : null,
            ($asset instanceof Document)
                ? Value::fromString(Files::bytesToSizeString($asset->getResource()->getFileSize()))
                : null,
            $asset instanceof Document
                ? ($inBackend
                    ? $button
                    : new Link(
                        LinkVariant::VARIANT_REGULAR,
                        ArchaeopteryxLink::create(
                            $this->uriService->getAssetUri($asset),
                            $asset->getLabel(),
                            LinkTarget::TARGET_BLANK->value,
                            ['noopener', 'nofollow'],
                        ),
                        $button,
                        $inBackend
                    )
                )
                : null
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
                return Icon::specifiedWith(IconName::NAME_ARROW_RIGHT, IconSize::SIZE_REGULAR, IconColor::COLOR_DEFAULT);
        }
    }
}
