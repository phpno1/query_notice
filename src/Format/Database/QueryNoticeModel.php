<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/3/26
 * Time: 上午11:51
 */

namespace BugsLife\QueryNotice\Format\Database;

use Illuminate\Database\Eloquent\Model;

class QueryNoticeModel extends Model
{
    protected $table = 'query_notices';

    protected $fillable = ['query', 'time', 'is_deal', 'controller', 'function'];
}