#!/bin/bash
# My first script

rsync -rtvu /Users/Susan/Sites/dwa15-fall2013/* dwapract@thedoctor.asmallorange.com:/home/dwapract/www/mirror/

echo 'done'