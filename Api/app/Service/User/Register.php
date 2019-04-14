<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release:
 * Date: 2019-04-14
 */

namespace App\Service\User;


use App\Model\MessageUser;
use Kite\Service\AbstractService;

class Register extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.

        $user = new MessageUser();
        if((new MessageUser(['account' => $this->account]))->exist()) {
            throw new \Exception('This user is exist, you can login ', 400);
        }
        $user->import([
            'username' => $this->username,
            'account' => $this->account,
            'password' => $this->password,
            'status' => MessageUser::NORMAL_USER,
        ])->save();
        $data = $user->find()->where(['account' => $this->account])->execute()->fetch(\PDO::FETCH_ASSOC);
        return ['id' => $data['id'], 'name' => $data['username']];

    }
}
