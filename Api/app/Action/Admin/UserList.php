<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-06-04
 */

namespace app\Action\Admin;


use Kite\Action\AbstractAction;

class UserList extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '调用此接口的用户的用户id',
            'rules' => ['required'],
            'message' => '用户id不能为空'
        ],
        'active' => [
            'desc' => '用户的账户状态 0 正常 1封禁',
            'default' => 0,
        ],
        'query' => [
            'desc' => '用于查找的账户',
            'default' => -1,
        ],
        'page' => [
            'desc' => '分页页码',
            'message' => '页码错误',
            'rules' => ['Logic:gt:0'],
            'default' => 1
        ],
        'limit' => [
            'desc' => '每一页的数据存储',
            'rules' => ['Logic:gt:0'],
            'default' => 5
        ],
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        if(!isset($this->params['active'])) {
            $this->params['active'] = 0;
        }
        $service = $this->Service('Admin\UserList');
        $service->page = $this->params['page'];
        $service->limit = $this->params['limit'];
        $service->id = $this->params['id'];
        $service->active = $this->params['active'];
        $service->query = $this->params['query'];
        $result = $service->run();
        $this->response($result);
    }
}
