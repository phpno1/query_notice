<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/2/24
 * Time: 上午11:51
 */

namespace BugsLife\QueryNotice;


interface Notice
{

    /**
     * Start sql query notice.
     * @return mixed
     */
    public function notice();

}