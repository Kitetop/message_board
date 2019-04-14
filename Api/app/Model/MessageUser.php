<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-14
 */

namespace App\Model;


use Kite\Model\AbstractModel;

class MessageUser extends AbstractModel
{
    const NORMAL_USER = 2;
    const ADMINER = 1;
    protected function table()
    {
        // TODO: Implement table() method.
        return 'message_user';
    }
}
