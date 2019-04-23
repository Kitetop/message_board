<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-14
 */

namespace App\Service;


use App\Model\MessageUser;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class Login extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $user = new MessageUser(['account' => $this->account, 'password' => $this->password]);
        if($user->exist()) {
            $date =  ['id' => $user->id, 'username' => $user->username, 'status' => $user->status];
            return Response::success("登录成功", $date);
        }
        return Response::error(400, "账号或者密码错误");
    }
}
