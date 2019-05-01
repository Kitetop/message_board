<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-05-01
 */

namespace app\Service;

use App\Model\MessageResponse;
use App\Model\MessageUser;
use app\Service\Common\DeleteAll;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

/**
 * Class DeleteResponse
 * @package app\Service
 * 删除留言
 */
class DeleteResponse extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $user = new MessageUser(['id' => $this->userId]);
        if (!$user->exist()) {
            return Response::error(400, '不存在的用户，非法请求');
        }
        if ($user->status == MessageUser::ADMINER) {
            $response = $this->deleteByAdmin($this->id);
        } else {
            $response = $this->deleteBySelf($this->id, $this->userId);
        }
        return $response;
    }

    /**
     * @param $id
     * @return MessageResponse|array
     * 管理员删除留言
     */
    private function deleteByAdmin($id)
    {
        $response = $this->getResponse($id);
        if ($response instanceof MessageResponse) {
            return $this->delete($response, $id);
        } else {
            return $response;
        }
    }

    /**
     * @param $responseId
     * @param $userId
     * @return MessageResponse|array
     * 自己删除自己的留言
     */
    private function deleteBySelf($responseId, $userId)
    {
        $response = $this->getResponse($responseId);
        if ($response instanceof MessageResponse) {
            if ($response->user_response != $userId) {
                return Response::error(400, '没有权限删除此留言');
            }
            return $this->delete($response, $responseId);
        } else {
            return $response;
        }
    }

    /**
     * @param MessageResponse $response
     * @param $id
     * @return array
     * 删除留言的公共方法
     */
    private function delete(MessageResponse $response, $id)
    {
        $pdo = $response->getDao();
        try {
            $pdo->beginTransaction();
            if ($response->father_id == 0) {
                //删除父系留言
                $response->remove();
                DeleteAll::deleteFather($id);
            } else {
                //删除普通的留言
                $response->remove();
                DeleteAll::deleteResponse($id);
            }
            $pdo->commit();
            return Response::success('删除成功');
        } catch (\Exception $e) {
            $pdo->rollBack();
            return Response::error(400, '操作失败，请稍后在试');
        }
    }

    /**
     * @param $id
     * @return MessageResponse|array
     * 获得留言信息或者MessageResponse对象
     */
    private function getResponse($id)
    {
        $response = new MessageResponse(['id' => $id]);
        if (!$response->exist()) {
            return Response::error(400, '留言不存在，无法删除');
        }
        return $response;
    }
}
