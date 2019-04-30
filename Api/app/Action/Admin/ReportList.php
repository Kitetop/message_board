<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-30
 */

namespace app\Action\Admin;

use Kite\Action\AbstractAction;

/**
 * Class ReportList
 * @package app\Action\Admin
 * 显示最近被举报比较多的留言
 */
class ReportList extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '调用此接口的用户的用户id',
            'rules' => ['required'],
            'message' => '用户id不能为空'
        ],
        'type' => [
            'desc' => '0 最近一天 1 最近一个礼拜 2 最近一个月',
            'rules' => ['required', 'enum:0,1,2'],
            'message' => '请设置合理的查看类型'
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
        $service = $this->Service('Admin\ReportList');
        $service->page = $this->params['page'];
        $service->limit = $this->params['limit'];
        $service->id = $this->params['id'];
        $service->type = $this->params['type'];
        $result = $service->run();
        $this->response($result);
    }
}
