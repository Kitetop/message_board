<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release:
 * Date: 2019-04-14
 */

namespace App\Service\User;


use App\Model\MessageUser;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class Register extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $user = new MessageUser();
        if((new MessageUser(['account' => $this->account]))->exist()) {
            return Response::error(400, '用户已经存在，无需注册');
        }
        $path = $this->setPath($this->account, $this->image);
        try {
            $user->import([
                'username' => $this->username,
                'account' => $this->account,
                'password' => $this->password,
                'sex' => $this->sex,
                'image' => $path,
                'status' => MessageUser::NORMAL_USER,
            ])->save();
            $this->image->moveTo($this->config['upload'] . '/user/'. $path);
            return Response::success('用户创建成功');
        }catch (\Exception $e) {
            return  Response::error(400, '用户创建失败，请稍后在试');
        }
    }

    private function setPath($account, $image)
    {
        return md5($account) . time() . '.' . $image->getExt();
    }
}
