# query_notice
In laravel,When you listen sql query and notice your by email.You can use this repository.

## Installation
```
composer require bugslife/query_notice
```
## Provider
```
BugsLife\QueryNotice\Providers\QueryNoticeProvider::class,
```
## Resource & Config
```
php artisan vendor:publish --tag=queryNotice
```
## Usage
You can use it in the entire project, or use the middleware locally.Support log query or email to relevant developers.

#### Use it in the entire project.Set config/queryNotice.php.default is close.
```
    /*
     * Open all object.
     */
    'is_all_object' => true,
```
#### Use the middleware locally.Set app\Http\Kernel.php.and use it.

```
    protected $routeMiddleware = [
        ...
        'query_notice' => \BugsLife\QueryNotice\Middleware\QueryMiddleware::class,
    ];
```
#### Write notice in log.Set config/queryNotice.php.default is open.
```
    /*
     * Set notice type open state. true equal open.
     */
    'notice_type_state' => [
        'log' => true,
        'mail' => false,
        'db' => false,
    ],
```
#### Write notice in log.When sql query run time is not greater than max time.Don't write in log? true is write.Set config/queryNotice.php.default is open.
```
    /*
     * When sql query run time is not greater than max time.Don't write in log? true is write.
     */
    'is_filter_log' => true,
```
#### Notice in users email.Set config/queryNotice.php.default is close.
```
    /*
     * Set notice type open state. true equal open.
     */
    'notice_type_state' => [
        'log' => true,
        'mail' => true,
        'db' => false,
    ],
```
## Extend your notice type
#### You can extends "BugsLife\QueryNotice\Format\Format.php" and write function run().Set your format in "config\queryNotice.php".
Demo
```
use BugsLife\QueryNotice\Format\Format;

class DatabaseFormat extends Format
{

    /**
     * Start use this format notice sql query.
     * @param $notice
     * @return mixed
     */
    public function run($notice)
    {
        // TODO: Implement run() method.
    }
```
```
    /*
     * Extend notice type.
     */
    'extend_notice_type' => [
        //Base format.This is demo.
        ...
        'db' => \Facades\BugsLife\QueryNotice\Format\Database\DatabaseFormat::class,
    ],
```
set Switch
```
    /*
     * Set notice type open state. true equal open.
     */
    'notice_type_state' => [
        'log' => true,
        'mail' => true,
        'db' => true,
    ],
```
## Feature
1.Write in database.
