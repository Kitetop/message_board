<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace App\Action\User;


use Kite\Action\AbstractAction;

class ThemeList extends AbstractAction
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
        'type' => [
            'desc' => '帖子的排行区别 0 最活跃 1最新',
            'rules' => ['required', 'enum:0,1'],
            'default' => 0,
            'message' => '请选择正确的排序标准'
        ],
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('User\ThemeList');
        $service->page = $this->params['page'];
        $service->limit = $this->params['limit'];
        $service->type = $this->params['type'];
        $result = $service->run();
        $this->response($result);
    }
}
