Run app server:
    docker start wordpress_mysql
    docker run -it -v $(pwd):/app --rm -p 8080:8080 -p 8000:8000 \
        --link wordpress_mysql mhariri/docker-google-appengine-php


First time running on this machine? then you need to setup database:

# Run:

    docker run -d -e MYSQL_ALLOW_EMPTY_PASSWORD=yes -p 3306:3306 --name wordpress_mysql mysql

# create the database (if does not exist already)

    docker exec -it wordpress_mysql mysql
    > create database wordpress_db;


# Open http://localhost:8080/wp-admin/install.php



If not first time, just start the db:

    docker start wordpress_mysql

Login with admin/admin


To upload:

    for once:
        gcloud config set project vphone-1339 
    gcloud app deploy



# Run tests

Run `run_tests.sh`
If using docker image: `docker exec -it xyz /app/run_tests.sh`

# update certificates

Just run :

    ~/workspace/letsencrypt/letsencrypt-auto renew

And copy-paste certificates by:

    sudo cat /etc/letsencrypt/archive/vphone.io/fullchain2.pem
    sudo openssl rsa -in /etc/letsencrypt/archive/vphone.io/privkey2.pem


## Just for the first time certificate creation

Run in letsencrypt:

    ./letsencrypt-auto certonly --manual

Set domains to vphone.io,www.vphone.io

Set the well-known token as the instructions say

# To upgrade wordpress

Download latest, and copy the files manually
Then apply this patch:

     patch -p 1 < wp_upgrade.patch


# To check activations

     curl -v -XPOST -d '{"phone_number":"467258573121", "email":"m.hariri@gmailcom"}' -H "Content-Type: application/json" "http://localhost:8080/api/activations/"
