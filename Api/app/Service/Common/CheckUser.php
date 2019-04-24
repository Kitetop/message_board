<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-15
 */

namespace App\Service\Common;


use App\Model\MessageUser;

/**
 * Class CheckUser
 * @package App\Service\Common
 * 对用户的身份进行验证
 */
final class CheckUser
{
    private $user;

    public function __construct(MessageUser $user)
    {
        $this->user = $user;
    }

    /**
     * 验证此用户是否是管理员
     * @param MessageUser $user
     * @return
     */
    public function checkStatus(MessageUser $user)
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
