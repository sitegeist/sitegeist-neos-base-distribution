ARG BASE_IMAGE
FROM $BASE_IMAGE
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y -o Dpkg::Options::="--force-confold" --no-install-recommends --no-install-suggests make g++ automake autoconf zlib1g-dev
RUN npm install --global imagemin-cli imagemin-pngquant imagemin-webp imagemin-mozjpeg
