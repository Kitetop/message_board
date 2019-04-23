<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-15
 */

namespace App\Service\Common;


use App\Model\MessageUser;
use Kite\Service\AbstractService;

/**
 * Class CheckUser
 * @package App\Service\Common
 * 对用户的身份进行验证
 */
class CheckUser extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        if(!$this->user->exists()) {
            throw new \Exception('This user not exists', 400);
        }
        switch ($this->type) {
            case 'status':
                return $this->checkStatus($this->user);
                break;
            case 'self':
                return $this->checkSelf();
            default:
                return true;
        }
    }

    /**
     * 验证此用户是否是管理员
     * @param MessageUser $user
     * @return
     */
    private function checkStatus(MessageUser $user)
    {
        if($user->status == MessageUser::ADMINER) {
            return true;
        }
        return false;
    }

    private function checkSelf()
    {

    }
}
