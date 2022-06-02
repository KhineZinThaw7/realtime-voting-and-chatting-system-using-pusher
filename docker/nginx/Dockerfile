FROM nginx:alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=UTC

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

# nginx config file
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/

WORKDIR /work/src
