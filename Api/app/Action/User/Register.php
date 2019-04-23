<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-14
 */

namespace App\Action\User;


use Kite\Action\AbstractAction;
use Kite\Service\AbstractService;

class Register extends AbstractAction
{
    private $postRules = [
        'account' => [
            'desc' => '注册号码',
            'rules' => ['mobile'],
            'message' => '无效的电话号码'
        ],
        'password' => [
            'desc' => '用户密码',
            'rules' => ['required'],
            'message' => '密码不能为空'
        ],
        'username' => [
            'desc' => '用户名',
            'rules' => ['required'],
            'message' => '用户名不能为空'
        ],
        'sex' => [
            'desc' => '用户性别',
            'rules' => ['required', 'enum:0,1,2'],
            'message' => '非法的性别设置'
        ],
    ];

    private $postImage = [
        'image' => [
            'rules' => ['required', 'mime:image/jpeg,image/jpg,image/png,image/gif'],
            'message' => '用户头像不能为空',
            'desc' => '用户头像',
        ]
    ];

    public function doPost()
    {
        $this->validate($this->postRules);
        $this->validateUploadFile($this->postImage);
        $service = $this->Service('User\Register');
        $service->account = trim($this->params['account']);
        $service->username = $this->params['username'];
        $service->password = md5(trim($this->params['password']));
        $service->sex = $this->params['sex'];
        $service->image = $this->validatedFiles['image'];
        $result = $service->run();
        $this->response($result);
        $this->code(201);
    }
}
