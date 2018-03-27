<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/2/24
 * Time: 下午2:31
 */

namespace BugsLife\QueryNotice\Format\Database;

use BugsLife\QueryNotice\Format\Format;
use BugsLife\QueryNotice\Format\Database\QueryNoticeModel;

class DatabaseFormat extends Format
{
    private $model;

    /**
     * DatabaseFormat constructor.
     * @param \BugsLife\QueryNotice\Format\Database\QueryNoticeModel $queryNoticeModel
     */
    public function __construct(QueryNoticeModel $queryNoticeModel)
    {
        $this->model = $queryNoticeModel;
    }

    /**
     * Start use this format notice sql query.
     * @param $notice
     * @return mixed
     */
    public function run($notice)
    {
        $this->model->create($notice);
    }

}