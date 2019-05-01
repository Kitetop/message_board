<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-05-01
 */

namespace app\Action;


use Kite\Action\AbstractAction;

class DeleteResponse extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '需要删除的留言的留言的id',
            'rules' => ['required'],
            'message' => '要删除的留言的id不能为空'
        ],
        'userId' => [
            'desc' => '进行删除操作的用户id',
            'rules' => ['required'],
            'message' => '用户id不能为空'
        ]
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('DeleteResponse');
        $service->id = $this->params['id'];
        $service->userId = $this->params['userId'];
        $result = $service->run();
        $this->response($result);
    }
}
