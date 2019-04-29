<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-29
 */

namespace app\Action\User;


use Kite\Action\AbstractAction;

/**
 * Class ResAgrOrRep
 * @package app\Action\User
 * 用户举报或者点赞评论的接口
 */
class ResAgrOrRep extends AbstractAction
{
    private $getRules = [
        'id' => [
            'desc' => '需要进行点赞或者举报的留言的id',
            'rules' => ['required'],
            'message' => '留言id不能为空'
        ],
        'type' => [
            'desc' => '0代表点赞，1代表举报',
            'rules' => ['required', 'enum:0,1'],
            'message' => '请设置合理的操作'
        ]
    ];

    protected function doGet()
    {
        $this->validate($this->getRules);
        $service = $this->Service('User\ResAgrOrRep');
        $service->id = $this->params['id'];
        $service->type = $this->params['type'];
        $result = $service->run();
        $this->response($result);
    }
}
