#/usr/bin/bash
#
# This script starts containers with static volumes attached
# It is a last part of README file
# I created a bash script to save some time :)
# No empty strings between \ and &&

docker run -d --name=redis --network=sdnet0 \
                   -v redisdata:/data \
                   redis:alpine \
	&& docker run -d --name=mysql \
                   --network=sdnet0 \
                   -v mysqldata:/var/lib/mysql \
                   -e MYSQL_ROOT_PASSWORD=root \
                   -e MYSQL_DATABASE=my-app \
                   -e MYSQL_USER=app-user \
                   -e MYSQL_PASSWORD=app-pass \
                   mysql:8.3.0 \
	&& docker run -d --name=php \
                   --network=sdnet0 \
                   -v $(pwd)/application:/var/www/html \
                   k4route/php:3.0.0 \
	&& docker run -d --name=nginx \
                   --network=sdnet0 \
                   -p 80:80 \
                   -v $(pwd)/application:/var/www/html \
                   k4route/nginx:3.0.0

