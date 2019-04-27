<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-24
 */

namespace App\Model;


use Kite\Model\AbstractModel;

class MessageResponse extends AbstractModel
{
    const TEXT = 0;
    const IMAGE = 1;
    protected function table()
    {
        // TODO: Implement table() method.
        return 'message_response';
    }
}
