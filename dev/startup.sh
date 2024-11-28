#!/bin/bash

echo "Copying custom default.conf over to /etc/nginx/conf.d/default.conf"

cp /home/dev/default /etc/nginx/sites-enabled/default
nginx -s reload