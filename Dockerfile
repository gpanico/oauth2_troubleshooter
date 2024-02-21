FROM ubuntu:20.04
ENV DEBIAN_FRONTEND noninteractive
ENV TERM linux
 
RUN apt-get update \
&& apt-get install -y --no-install-recommends php-cli php-curl
 
COPY index.php .
CMD mkdir -p flower/
COPY flower/index.php flower/index.php
COPY dev.inc flower/dev.inc
 
EXPOSE 5555
CMD ["/usr/bin/php", "-S", "0.0.0.0:5555"]
