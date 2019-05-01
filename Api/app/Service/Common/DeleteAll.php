<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-05-01
 */

namespace app\Service\Common;

use App\Model\MessageResponse;

/**
 * Class DeleteAll
 * @package app\Service\Common
 * 删除所有有关联关系留言
 */
final class DeleteAll
{
    public static function deleteFather($id)
    {
        $response = new MessageResponse();
        $response->remove(['father_id'=> $id]);
    }

    public static function deleteResponse($id)
    {
        $response = new MessageResponse();
        $response->remove(['response_id' => $id]);
    }

}
