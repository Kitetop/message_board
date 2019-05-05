<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-28
 */

namespace app\Action\User;

use Kite\Action\AbstractAction;

class ResChildList extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '父楼的id',
            'rules' => ['required'],
            'message' => '父楼id不能为空',
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
            'default' => 2
        ],
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('User\ResChildList');
        $service->id = $this->params['id'];
        $service->page = $this->params['page'];
        $service->limit = $this->params['limit'];
        $result = $service->run();
        $this->response($result);
    }
}
