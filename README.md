Run app server:
    docker run -v $(pwd):/app --rm --net=host mhariri/docker-google-appengine-php


First time running on this machine? then you need to setup database:

# Run:

    docker run -d -e MYSQL_ROOT_PASSWORD=password -p 3306:3306 --name wordpress_mysql mysql

# create the database (if does not exist already)

    docker exec -it wordpress_mysql mysql -p
    > create database wordpress_db;

# Open http://localhost:8080/wp-admin/install.php



If not first time, just start the db:

    docker start wordpress_mysql

Login with admin/admin


To upload:

    ~/google_appengine/appcfg.py update .



# Run tests

Run `run_tests.sh`
If using docker image: `docker exec -it xyz /app/run_tests.sh`

# update certificates

Just run :

    letsencrypt-auto renew

And copy-paste certificates by:

    sudo cat /etc/letsencrypt/archive/vphone.io/fullchain2.pem
    sudo openssl rsa -in /etc/letsencrypt/archive/vphone.io/privkey2.pem


## Just for the first time certificate creation

Run in letsencrypt:

    ./letsencrypt-auto certonly --manual

Set domains to vphone.io,www.vphone.io

Set the well-known token as the instructions say
