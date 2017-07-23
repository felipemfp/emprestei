FROM nginx:1.10-alpine

ADD ./deploy/vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www