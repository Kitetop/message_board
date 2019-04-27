<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Service\User;


use App\Model\MessageResponse;
use Kite\Commons\Page;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

/**
 * Class ResponseList
 * @package app\Service\User
 * 显示帖子的留言
 */
class ResFatherList extends AbstractService
{
    //留言的对象 => MessageResponse
    private $response;
    protected function execute()
    {
        $this->response = new MessageResponse();
        $father = $this->findFather($this->id, $this->page, $this->limit);
        $total = $this->response->count(['theme_id' => $this->id, 'father_id' => 0])['total'];
        $url = $this->config['rootUrl'] . '/response/list?';
        Page::assemble($father, $total, $this->page, $this->limit);
        list($father['prev'], $father['next']) = Page::simple($father['meta'], $url, $this->params);
        unset($father['meta']);
        return Response::success(null, $father);
    }

    /**
     * @param $themeId
     * @param $page
     * @param $limit
     * @return mixed
     * @throws \Exception
     * 获得帖子下的直系留言
     */
    private function findFather($themeId, $page, $limit)
    {
        $where = [
            'theme_id' => $themeId,
            'father_id' => 0
        ];
        $result = $this->response->find()
            ->where($where)
            ->order(['agree' => 'DESC'])
            ->page(($page - 1) * $limit, $limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
        $this->setReturn($result);
        return $result;
    }

    /**
     * @param $results
     * @throws \Exception
     * 设定返回的数据格式
     */
    private function setReturn(&$results)
    {
        foreach ($results as &$value) {
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
            $context = unserialize($value['context']);
            $context['type'] == MessageResponse::TEXT && $value['context'] = $context['text'];
            $context['type'] == MessageResponse::IMAGE && $value['context'] = $this->config['imageUrl'] . $context['text'];
        }
    }
}
