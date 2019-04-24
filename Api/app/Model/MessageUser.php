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
    //用户身份常量
    const NORMAL_USER = 2;
    const ADMINER = 1;

    //用户状态常量
    const ACTIVE = 0;
    const BAN =1;

    protected function table()
    {
        // TODO: Implement table() method.
        return 'message_user';
    }
}
