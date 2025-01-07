FROM nginx:alpine

LABEL maintainer="phihv.soict@gmail.com"

# Cài đặt OpenSSL và các công cụ cần thiết
RUN apk update && apk add --no-cache bash curl openssl

# Tạo thư mục cần thiết
RUN mkdir -p /etc/nginx/ssl /var/www/certbot

# Tạo chứng chỉ tự ký (self-signed certificate)
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
        -keyout /etc/nginx/ssl/privkey.pem \
        -out /etc/nginx/ssl/fullchain.pem \
        -subj "/C=US/ST=State/L=City/O=Organization/OU=OrgUnit/CN=ddd-laravel.local"

# Copy cấu hình Nginx
COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Expose các cổng HTTP và HTTPS
EXPOSE 80 443

# Khởi động Nginx
CMD ["nginx", "-g", "daemon off;"]
