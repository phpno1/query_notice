<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/2/24
 * Time: 下午1:53
 */

namespace BugsLife\QueryNotice\Format\Log;

use BugsLife\QueryNotice\Format\Format;

class LogFormat extends Format
{

    /**
     * Start use this format notice sql query.
     * @param $notice
     * @return mixed
     */
    public function run($notice)
    {
        \Log::info($this->name, $notice);
    }
}