<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-25
 */

namespace App\Service\User;


use App\Model\MessageResponse;
use App\Model\MessageTheme;
use App\Model\MessageUser;
use App\Service\Common\TimeDeal;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class AddResponse extends AbstractService
{
    private $user;
    private $theme;
    private $response;

    protected function execute()
    {
        $check = $this->initCheck();
        if ($check === true) {
            $context = $this->getContext();
            if ($this->fatherId == 0 && $this->responseId == 0) {
                //直接回复帖子的留言
                $notice = $this->theme->user_id;
            } else {
                //回复帖子内留言的留言
                $notice = $this->response->user_response;
            };
            try {
                $pdo = $this->user->getDao();
                $pdo->beginTransaction();
                $this->saveResponse($notice, $context);
                /**之后要添加添加提示的接口
                 * notice == notice 回复留言的文本信息
                 * response == user_response 回复留言的用户id
                 * accept == user_accept 接收留言者id
                 * responseId == response_id 自己被回复的留言的id
                 * themeId == theme_id
                 */
                $this->call('User\AddNotice',[
                    'notice' => $context,
                    'response' => $this->userId,
                    'accept' => $notice,
                    'themeId' => $this->themeId,
                    'responseId' => $this->responseId,

                ]);
                $pdo->commit();
                return Response::success('回复成功');
            } catch (\Exception $e) {
                $pdo->rollBack();
                return Response::error(400, '回复失败，请稍后在试');
            }

        } else {
            return $check;
        }
    }

    /**
     * @return array|bool
     * 存储留言的前置检测
     */
    private function initCheck()
    {
        $this->user = new MessageUser(['id' => $this->userId]);
        if (!$this->user->exist() || $this->user->active == MessageUser::BAN) {
            return Response::error(400, '非法用户，无法进行回复留言');
        }
        $this->theme = new MessageTheme(['id' => $this->themeId]);
        if (!$this->theme->exist()) {
            return Response::error(400, '回复的帖子不存在');
        }
        //检测回复留言的留言各种id设置是否合理
        return $this->checkResponse();
    }

    /**
     * @return array|bool
     * 避免fatherId 和 responseId不统一的问题
     */
    private function checkResponse()
    {
        if(($this->responseId == 0 || $this->fatherId == 0) && ($this->responseId != $this->fatherId)) {
            return Response::error(400, '非法的留言请求');
        }
        if($this->responseId != 0) {
            $this->response = new MessageResponse(['id' => $this->responseId]);
            $father = new MessageResponse(['id' => $this->fatherId]);
            if (!$this->response->exist()) {
                return Response::error(400, '回复的留言不存在');
            }
            if(!$father->exist() || $father->father_id != 0) {
                return Response::error(400, '无效的父系留言');
            }
        }
        return true;
    }

    /**
     * @return string
     * 获得留言的文本信息
     */
    private function getContext()
    {
        if ($this->type == 0) {
            return serialize([
                'type' => 0,
                'text' => $this->text
            ]);
        } else {
            //对图片信息回复进行处理
            $path = $this->setPath($this->themeId, $this->text);
            $this->text->moveTo($this->config['upload'] . $path);
            return serialize([
                'type' => 1,
                'text' => $path
            ]);
        }
    }

    /**
     * @param $notice
     * @param $context
     * 存储信息 更新帖子表中的回复数量字段
     */
    private function saveResponse($notice, $context)
    {
        $time = TimeDeal::getTime('Y-m-d H:i:s');
        $response = new MessageResponse();
        $response->import([
            'theme_id' => $this->themeId,
            'father_id' => $this->fatherId,
            'response_id' => $this->responseId,
            'user_response' => $this->userId,
            'user_accept' => $notice,
            'time' => $time,
            'agree' => 0,
            'report' => 0,
            'context' => $context,
        ])->save();
        $this->theme->response_num += 1;
        $this->theme->save();
    }

    /**
     * @param $theme
     * @param $image
     * @return string
     * 如果上传的是图片，获得唯一得文件名
     */
    private function setPath($theme, $image)
    {
        return '/response/' . md5($theme . $this->userId) . time() . '.' . $image->getExt();
    }
}
