<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Action\User;


use Kite\Action\AbstractAction;

class UserInfo extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '用户的id',
            'rules' => ['required'],
            'message' => '用户id不能为空'
        ]
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('Common\UserInfo');
        $service->id = $this->params['id'];
        $result = $service->run();
        $this->response($result);
    }
}
