<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-30
 */

namespace app\Action\Admin;


use Kite\Action\AbstractAction;

/**
 * Class BanOrRelUser
 * @package app\Action\Admin
 * 对用户进行解禁或者封禁
 */
class BanOrRelUser extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '执行操作的管理员的id',
            'rules' => ['required'],
            'message' => '管理员id不能为空',
        ],
        'type' => [
            'desc' => '区分是封禁还是解禁用户 0 解禁 1 封禁',
            'rules' => ['required' ,'enum:0,1'],
            'message' => '请设置合理的操作类型',
        ],
        'userId' => [
            'desc' => '要改变的用户的id',
            'rules' => ['required'],
            'message' => '用户id不能为空',
        ]
    ];

    /**
     * @throws \Exception
     * 对用户进行封禁或者解禁操作
     */
    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('Admin\BanOrRelUser');
        $service->id = $this->params['id'];
        $service->type = $this->params['type'];
        $service->userId = $this->params['userId'];
        $result = $service->run();
        $this->response($result);
    }
}
