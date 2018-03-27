<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/2/24
 * Time: 下午1:52
 */

namespace BugsLife\QueryNotice\Format;


abstract class Format
{
    /**
     * Notice format name.
     */
    protected $name;

    /**
     * Set notice format.
     */
    protected $format = '';

    /**
     * Format constructor.
     */
    public function __construct()
    {
        $this->name = config('queryNotice.name');
        $this->format = config('queryNotice.format') ?? $this->format;
    }

    /**
     * Start use this format notice sql query.
     * @param $notice
     * @return mixed
     */
    public abstract function run($notice);

}