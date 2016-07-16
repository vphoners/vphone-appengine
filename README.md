Run app server:
    docker run -v $(pwd):/app --rm --net=host mhariri/docker-google-appengine-php


First time running on this machine? then you need to setup database:

# Run:

    docker run -d -e MYSQL_ROOT_PASSWORD=password -p 3306:3306 --name wordpress_mysql mysql

# create the database (if does not exist already)

    mysql -h 127.0.0.1 -uroot -p
    > create database wordpress_db;

# Open http://localhost:8080/wp-admin/install.php



If not first time, just start the db:

    docker start wordpress_mysql

Login with admin/admin


To upload:

    ~/google_appengine/appcfg.py update .
