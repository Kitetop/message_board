<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-24
 */

namespace App\Service\User;


use App\Model\MessageTheme;
use App\Model\MessageUser;
use App\Service\Common\TimeDeal;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class AddTheme extends AbstractService
{
    protected function execute()
    {
        $user = new MessageUser(['id' => $this->id]);
        if(!$user->exist() || $user->active == MessageUser::BAN) {
            return Response::error(400, '非法用户，无法发表');
        }
        $time = TimeDeal::getTime('Y-m-d H:i:s');
        $theme = new MessageTheme();
        $theme->import([
            'user_id' => $this->id,
            'title' => $this->title,
            'context' => $this->context,
            'response_num' => 0,
            'time' => $time
        ])->save();
        return Response::success("帖子发布成功");
    }
}
