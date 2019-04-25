<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-25
 */

namespace App\Action\User;


use Kite\Action\AbstractAction;
use Kite\Commons\Response;

class AddResponse extends AbstractAction
{
    private $postRules = [
        'themeId' => [
            'rules' => ['required'],
            'message' => '回复的帖子id不能为空',
            'desc' => '回复的帖子的id'
        ],
        'userId' => [
            'rules' => ['required'],
            'message' => '回复用户id不能为空',
            'desc' => '回复者的用户id'
        ],
        'fatherId' => [
            'desc' => '父系留言的id'
        ],
        'responseId' => [
            'desc' => '回复留言的留言id'
        ],
        'type' => [
            'rules' => ['required','enum:0,1'],
            'message' => '回复内容类型设置错误',
            'desc' => '确定用户回复内容的类型，0 文本 1 图片'
        ],
        'text' => [
            'desc' => '回复的文本信息'
        ]
    ];

    private $postImage = [
        'image' => [
            'rules' => ['required', 'mime:image/jpeg,image/jpg,image/png,image/gif'],
            'message' => '请上传正确的回复图片',
        ]
    ];

    protected function doPost()
    {
        $this->validate($this->postRules);
        isset($this->params['text']) || $this->params['text'] = null;
        $text = trim($this->params['text']);
        if($this->params['type'] == 1) {
            $this->validateUploadFile($this->postImage);
            $text = $this->validatedFiles['image'];
        }
        if($text == null) {
            Response::error(400, '请输入你的回复信息');
        }
        isset($this->params['fatherId']) || $this->params['fatherId'] = 0;
        isset($this->params['responseId']) || $this->params['responseId'] = 0;
        $service = $this->Service('User\AddResponse');
        $service->text = $text;
        $service->type = $this->params['type'];
        $service->themeId = trim($this->params['themeId']);
        $service->userId = trim($this->params['userId']);
        $service->fatherId = trim($this->params['fatherId']);
        $service->responseId = trim($this->params['responseId']);
        $result = $service->run();
        $this->response($result);
    }
}
