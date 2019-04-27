<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Action\User;


use Kite\Action\AbstractAction;

class ResFatherList extends AbstractAction
{
    protected $getRules = [
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
        'id' => [
            'rules' => ['required'],
            'message' => '查询留言的帖子的id不能为空',
            'desc' => '要查看留言所属的帖子的id'
        ]
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('User\ResFatherList');
        $service->page = $this->params['page'];
        $service->limit = $this->params['limit'];
        $service->id = $this->params['id'];
        $result = $service->run();
        $this->response($result);
    }
}
