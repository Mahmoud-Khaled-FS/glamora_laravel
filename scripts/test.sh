#!/usr/bin/env bash

set -ex

php artisan test --bootstrap="./src/Tests/Pest.php"