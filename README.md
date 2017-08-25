# Wordpress Development

## Features

* Local Development with Vagrant box and Remote Deployment using [Trellis](https://github.com/roots/trellis)
* WP Boilerplate using [Bedrock](https://github.com/roots/bedrock)
* Manage database uplooads and migration using  [trellis-database-uploads-migration](https://github.com/valentinocossar/trellis-database-uploads-migration)

## Development Process

1. [Install](https://roots.io/trellis/docs/installing-trellis/) Trellis and Bedrock
2. Clone my theme Boilerplate

## Deployment

```sh
./bin/deploy.sh production [example.com]
```

## DB Upload and Migration
```sh
 sh./bin/database.sh [environment] [site name] [push/pull]
 ```
```sh
 ./bin/uploads.sh [environment] [site name] [push/pull]
 ```
