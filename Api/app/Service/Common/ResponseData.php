<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-28
 */

namespace app\Service\Common;


use App\Model\MessageResponse;
use Kite\Service\AbstractService;

/**
 * Class ResponseData
 * @package app\Service\Common
 * 设置返回消息的公共服务
 */
class ResponseData extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $result = $this->result;
        $timeDeal = new TimeDeal();
        foreach ($result as &$value) {
            $user = $this->call('Common\UserInfo', [
                'id' => $value['user_response']
            ])['data'];
            unset($value['user_response']);
            unset($value['user_accept']);
            unset($value['father_id']);
            unset($value['response_id']);
            unset($value['theme_id']);
            $value['user_name'] = $user['username'];
            $value['user_sex'] = $user['sex'];
            $value['user_image'] = $user['image'];
            $value['time'] = $timeDeal->formatTime($value['time']);
            $context = unserialize($value['context']);
            $value['type'] = $context['type'];
            $context['type'] == MessageResponse::TEXT && $value['context'] = $context['text'];
            $context['type'] == MessageResponse::IMAGE && $value['context'] = $this->config['imageUrl'] . $context['text'];
        }
        return $result;
    }
}
