<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release:
 * Date: 2019-04-14
 */

namespace App\Service\User;


use App\Model\MessageUser;
use Kite\Service\AbstractService;

class Login extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $user = new MessageUser(['account' => $this->account, 'password' => $this->password]);
        if($user->exist()) {
            return ['id' => $user->id, 'username' => $user->username, 'status' => $user->status];
        }
        throw new \Exception('账户或密码不正确', 400);
    }
}
