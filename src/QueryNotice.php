<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/2/24
 * Time: 上午11:54
 */

namespace BugsLife\QueryNotice;


class QueryNotice implements Notice
{
    const DB_QUERY_STRING = ['/query_notices/', '/information_schema/'];

    /**
     * Sql query notice open state.
     */
    protected $is_open;

    /**
     * Sql query notice time to second.
     */
    protected $is_second;

    /**
     * Sql query notice type open state.
     */
    protected $notice_type_state;

    /**
     * Sql query notice base type.
     */
    private $notice_type = [
        'log' => \Facades\BugsLife\QueryNotice\Format\Log\LogFormat::class,
        'mail' => \Facades\BugsLife\QueryNotice\Format\Mail\MailFormat::class,
        'db' => \Facades\BugsLife\QueryNotice\Format\Database\DatabaseFormat::class,
    ];

    /**
     * Sql query run time is greater than max time.
     */
    private $max_time;

    /**
     * When sql query run time is not greater than max time.Don't write in log? true is write.
     */
    private $is_filter_log;

    /**
     * QueryNotice constructor.
     */
    public function __construct()
    {
        $this->is_second = config('queryNotice.is_second');
        $this->is_open = config('queryNotice.is_open');
        $this->notice_type_state = config('queryNotice.notice_type_state');
        $this->notice_type = array_merge($this->notice_type, config('queryNotice.extend_notice_type') ?? []);
        $this->max_time = config('queryNotice.max_time');
        $this->is_filter_log = config('queryNotice.is_filter_log');
    }

    /**
     * Start sql query notice.
     * @return mixed
     */
    public function notice()
    {
        if ($this->is_open) {
            $this->listen();
        }
    }

    /**
     * Listen sql query.
     */
    public function listen()
    {
        \DB::listen(function ($sql) {
            $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
            $query = vsprintf($query, $sql->bindings);
            $time = $this->is_second ? $sql->time / 1000 : $sql->time;
            $notice = [
                'query' => $query,
                'time' => $time
            ];
            $this->noticeType(array_merge($notice, $this->getModule()));
        });
    }

    /**
     * Notice Type
     * @param $notice
     */
    public function noticeType($notice)
    {
        foreach ($this->notice_type_state as $key => $value) {
            //Insert notice break.
            if ($this->isDbSql($notice['query'])) {
                break;
            }

            if ($value) {
                $this->notice_type[$key]::run($notice);
                if ($this->isFilterLog($key) || $this->isMaxTime($notice['time'])) {
                    $this->notice_type[$key]::run($notice);
                }
            }
        }
    }

    /**
     * @param $notice_type_name
     * @return bool
     */
    public function isFilterLog($notice_type_name)
    {
        return strcasecmp($notice_type_name, 'log') === 0 && $this->is_filter_log;
    }

    /**
     * Sql query run time is greater than max time.
     * @param $time
     * @return bool
     */
    public function isMaxTime($time)
    {
        return $this->max_time < ceil($time);
    }

    /**
     * Database query not notice.
     * @param $query
     * @return bool
     */
    public function isDbSql($query)
    {
        foreach (self::DB_QUERY_STRING as $key => $value) {
            if (boolval(preg_match($value, $query))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get module info.
     * @return array
     */
    public function getModule()
    {
        $module_str = 'null@null';
        if (! \App::runningInConsole()) {
            $module_str = \Route::current()->getActionName();
        }
        $module = explode('@', $module_str);
        return [
            'controller' => $module[0],
            'function' => $module[1]
        ];
    }
}