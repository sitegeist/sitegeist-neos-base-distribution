<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Figure;

use PackageFactory\ComponentEngine as _;
use Sitegeist\Kaleidoscope\Cpx\Components\ImageSource\ImageSource;
use Sitegeist\Kaleidoscope\Cpx\Components\Image\Image;
use Vendor\Shared\Components\Block\Figure\FigureSize;

#[\Neos\Flow\Annotations\Proxy(false)]
final readonly class Figure implements _\ComponentInterface
{
    private function __construct(
        private Image $_1712_Image,
    ) {
    }

    public static function create(
        ImageSource $image,
        ?FigureSize $size,
        bool $isLazyLoaded,
    ): self {
        return new self(
            _1712_Image: Image::create(
                imageSource: $image,
                width: null,
                height: null,
                format: null,
                srcset: match ($size) { FigureSize::SIZE_FIFTH_HALF_FULL => '320w, 640w', FigureSize::SIZE_THIRD_HALF_FULL => '320w, 640w', FigureSize::SIZE_HALF_FULL_FULL => '320w, 640w, 870w', FigureSize::SIZE_FULL_FULL_FULL => '320w, 640w, 1000w, 1200w, 1440w, 1600w', FigureSize::SIZE_DEFAULT => '320w, 640w, 1000w, 1200w, 1440w, 1600w' },
                sizes: match ($size) { FigureSize::SIZE_FIFTH_HALF_FULL => '(min-width: 1024px) 20vw, (min-width: 640px) 50vw, 100vw', FigureSize::SIZE_THIRD_HALF_FULL => '(min-width: 640px) 50vw, (min-width: 1024px) 33vw, 100vw', FigureSize::SIZE_HALF_FULL_FULL => '(min-width: 768px) 50vw, 100vw', FigureSize::SIZE_FULL_FULL_FULL => '100vw', FigureSize::SIZE_DEFAULT => '100vw' },
                loading: ($isLazyLoaded ? 'lazy' : 'eager'),
                alt: null,
                title: null,
                class: 'w-full h-full object-cover',
            ),
        );
    }

    public function render(): string
    {
        return '<figure data-component="Figure" class="' . _\Util::joinAttributeValues(['[Block.Figure]', 'w-full h-full flex flex-col max-h-full relative']) . '">' . $this->_1712_Image->render() . '</figure>';
    }
}
