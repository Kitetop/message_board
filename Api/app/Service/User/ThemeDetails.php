<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Service\User;


use App\Model\MessageTheme;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class ThemeDetails extends AbstractService
{
    protected function execute()
    {
        $theme = new MessageTheme(['id' => $this->id]);
        if(!$theme->exist()) {
            return Response::error(400, '不存在的帖子');
        }
        $userInfo = $this->call('Common\UserInfo',['id' => $theme->user_id])['data'];
        $result = $this->setReturn($theme->getRows(), $userInfo);
        return Response::success(null, $result);
    }

    /**
     * @param $theme
     * @param $user
     * @return array $theme
     * 设置返回数据的指定格式
     */
    private function setReturn($theme, $user)
    {
        $theme['user_name'] = $user['username'];
        $theme['user_sex'] = $user['sex'];
        $theme['user_image'] = $user['image'];
        return $theme;
    }
}
