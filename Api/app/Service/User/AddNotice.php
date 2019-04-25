<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-25
 */

namespace App\Service\User;


use App\Model\MessageNotice;
use Kite\Service\AbstractService;

class AddNotice extends AbstractService
{
    protected function execute()
    {
        /**之后要添加添加提示的接口
         * notice == notice 回复留言的文本信息
         * response == user_response 回复留言的用户id
         * accept == user_accept 接收留言者id
         * responseId == response_id 自己被回复的留言的id
         * themeId == theme_id
         */
        $notice = new MessageNotice();
        $notice->import([
            'theme_id' => $this->themeId,
            'response_id' => $this->responseId,
            'notice' => $this->notice,
            'view' => MessageNotice::NOTVIEW,
            'user_response' => $this->response,
            'user_accept' => $this->accept,
        ])->save();
    }
}
