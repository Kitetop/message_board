<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-24
 */

namespace App\Action\User;


use Kite\Action\AbstractAction;

/**
 * Class AddTheme
 * @package App\Action\User
 * 增加帖子的接口
 */
class AddTheme extends AbstractAction
{
    private $postRules = [
        'id' => [
            'desc' => '创建帖子的用户id',
            'rules' => ['required'],
            'message' => '用户id不能为空'
        ],
        'title' => [
            'desc' => '帖子的标题',
            'rules' => ['required'],
            'message' => '帖子标题不能为空'
        ],
        'context' => [
            'desc' => '帖子的内容',
            'rules' => ['required'],
            'message' => '帖子主题不能为空'
        ]
    ];

    protected function doPost()
    {
        $this->validate($this->postRules);
        $service = $this->Service('User\AddTheme');
        $service->id = $this->params['id'];
        $service->title = trim($this->params['title']);
        $service->context = $this->params['context'];
        $result = $service->run();
        $this->response($result);
    }
}
