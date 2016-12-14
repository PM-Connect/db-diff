# DB Diff [![Latest Stable Version](https://poser.pugx.org/pm-connect/db-diff/v/stable)](https://packagist.org/packages/pm-connect/db-diff) [![Total Downloads](https://poser.pugx.org/pm-connect/db-diff/downloads.svg)](https://packagist.org/packages/pm-connect/db-diff) [![Latest Unstable Version](https://poser.pugx.org/pm-connect/db-diff/v/unstable.svg)](https://packagist.org/packages/pm-connect/db-diff) [![License](https://poser.pugx.org/pm-connect/db-diff/license.svg)](https://packagist.org/packages/pm-connect/db-diff)

A simple php based database structure diff tool that you can self host.

Looking to build a diff tool your self? Check out [db-diff-utils](https://github.com/PM-Connect/db-diff-utils).

[![DB Diff](https://raw.githubusercontent.com/PM-Connect/db-diff/master/public/img/db-diff.png)](https://github.com/PM-Connect/db-diff)

## Installation

You will need to install the project using a web server using php7+.

```
composer create-project --prefer-dist pm-connect/db-diff db-diff
```

### Config

You will need to set a database configuration to save the diff logs.

Once done, you will also need to run the migrations.

```
php artisan migrate
```

You can also optionally setup a queue to enable better performance for diff running.

#### Example `.env` File

```
APP_ENV=local
APP_KEY=base64:1v0HsWYBr3Onmy5WNqIIs2/s3d0moHRg9IPK4ZD0/rY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://db-diff.dev

DB_CONNECTION=sqlite

QUEUE_DRIVER=database

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```

#### Queues

If you opt to use a queue driver that is not `sync`, you will need to run the build-in queue worker through the command line.

```
php artisan queue:listen --queue=default
```

For more information on running queue workers, please see [here](https://laravel.com/docs/5.3/queues#running-the-queue-worker).

## Issues

Please submit any issues using GitHubs build in issue management.
