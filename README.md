# Example WebAPI with Laravel, TypeScript, Vue.js

## The Repository

This repository is a Example to develop Web API using [Laravel](https://laravel.com/), [TypeScript](https://www.typescriptlang.org/), [Vue.js](https://vuejs.org/).

## System Requirements

- [Apache](https://httpd.apache.org/)
- [SQLite](https://www.sqlite.org/)

## Requirement

- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)

## Install and Run

Install the required packages.

```
composer install
npm install
cp .env.template .env; php artisan key:generate
```

Database setup

```
touch database/database.sqlite
php artisan migrate
```

and start.

```
npm run production
```

## License

Copyright (c) ptplus.jp All rights reserved.

Licensed under the [Apache-2.0](LICENSE.txt) license.
