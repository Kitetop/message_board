<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: 0.1
 * Date: 2018/10/10
 */

namespace App\Service;


use Kite\Service\AbstractService;

class Test extends AbstractService
{
    protected function execute()
    {
        $message = 'This is Test execute function and username='.$this->username;
        return $message;
    }
}