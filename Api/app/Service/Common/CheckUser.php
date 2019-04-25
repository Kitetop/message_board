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
     * @return bool
     */
    public function checkStatus()
    {
        if($this->user->status == MessageUser::ADMINER) {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     * 验证是否是本人
     */
    private function checkSelf($id)
    {
        return ($this->user->id == $id);
    }
}
