<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-30
 */

namespace app\Service\Admin;


use App\Model\MessageUser;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class BanOrRelUser extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $admin = new MessageUser(['id' => $this->id]);
        if($admin->status != MessageUser::ADMINER) {
            return Response::error(400, '没有权限进行如下操作');
        }
        $user = new MessageUser(['id' => $this->userId]);
        if(!$user->exist()) {
            return Response::error(400, '不存在的用户，无法对其进行操作');
        }
        if($this->type == MessageUser::ACTIVE) {
            $user->active = MessageUser::ACTIVE;
            $user->save();
        } else {
            $user->active = MessageUser::BAN;
            $user->save();
        }
        return Response::success('操作成功');
    }
}
