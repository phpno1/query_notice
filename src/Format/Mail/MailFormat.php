<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/3/3
 * Time: 下午6:03
 */

namespace BugsLife\QueryNotice\Format\Mail;

use BugsLife\QueryNotice\Format\Format;
use Illuminate\Support\Facades\Mail;

class MailFormat extends Format
{
    /*
     * Send to users email.
     */
    private $emails = [];

    /**
     * MailFormat constructor.
     */
    public function __construct()
    {
        $this->emails = config('queryNotice.emails');
    }

    /**
     * Start use this format notice sql query.
     * @param $notice
     * @return mixed
     */
    public function run($notice)
    {
        foreach ($this->emails as $val){
            Mail::to($val)->send(new QueryNoticeMail($notice));
        }
    }
}