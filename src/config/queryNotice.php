<?php

return [

    /*
     * Name.
     */
    'name' => 'PHPNO1 query notice',

    /*
     * Open state.
     */
    'is_open' => true,

    /*
     * Time to second.
     */
    'is_second' => true,

    /*
     * Open all object.
     */
    'is_all_object' => true,

    /*
     * Extend notice type.
     */
    'extend_notice_type' => [
        //Base format.This is demo.
        //'log' => \Facades\BugsLife\QueryNotice\Format\Log\LogFormat::class,
        //'mail' => \Facades\BugsLife\QueryNotice\Format\Mail\MailFormat::class,
    ],

    /*
     * Set notice type open state. true equal open.
     */
    'notice_type_state' => [
        'log' => true,
        'mail' => false,
        'db' => false,
    ],

    /*
     * Sql query run time is greater than max time.(ps. second)
     */
    'max_time' => 2,

    /*
     * When sql query run time is not greater than max time.Don't write in log? true is write.
     */
    'is_filter_log' => true,

    /*
     * Your group users email.
     */
    'emails' => [
        '757470062@qq.com',
    ],

    /*
     * Paginate size.
     */
    'page' => 20,
];