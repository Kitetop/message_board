<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Service\Common;

use App\Model\MessageUser;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

/**
 * Class UserInfo
 * @package app\Service\Common
 * 根据用户id获得用户的相关信息
 */
class UserInfo extends AbstractService
{
    protected function execute()
    {
        $user = new MessageUser(['id' => $this->id]);
        if(!$user->exist()) {
            return Response::error(400, '不存在的用户');
        }
        $result = $user->getRows();
        //var_dump($result);die();
        $this->setShow($result);
        return Response::success(null, $result);
    }

    private function setShow(&$result) {
        unset($result['password']);
        $result['image'] = $this->config['imageUrl'] . $result['image'];
        $result['active'] == 0 && $result['active'] = '正常';
        $result['active'] == 1 && $result['active'] = '封禁';
    }
}
