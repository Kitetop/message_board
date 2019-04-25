<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-25
 */

namespace App\Model;


use Kite\Model\AbstractModel;

class MessageNotice extends AbstractModel
{
    const HADVIEW = 2;
    const NOTVIEW = 1;

    protected function table()
    {
        return 'message_notice';
    }
}
