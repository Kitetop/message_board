<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-28
 */

namespace app\Service\Common;

use App\Model\MessageResponse;
use Kite\Commons\Page;

final class ResponseFunc
{
    private $page;
    private $limit;
    private $id;
    private $response;

    public function __construct($id, $limit, $page)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->id = $id;
        $this->response = new MessageResponse();
    }

    /**
     * @return mixed 查询到的结果集
     */
    public function findFather()
    {
        $where = [
            'theme_id' => $this->id,
            'father_id' => 0
        ];
        $result = $this->response->find()
            ->where($where)
            ->order(['agree' => 'DESC'])
            ->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @return mixed
     * 得到父系节点的儿子留言
     */
    public function findChild()
    {
        $result = $this->response->find()
            ->where(['father_id' => $this->id])
            ->order(['agree' => 'DESC'])
            ->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param array $where
     * @return mixed
     * 查找指定举报次数多的留言
     */
    public function findMostReport(array $where)
    {
        $result = $this->response->find()
            ->where($where)
            ->order(['report' => 'DESC'])
            ->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $result
     * @param $url
     * @param $params
     * @param array|null $where
     * @return mixed
     * 返回得到的分页数据
     */
    public function getReturn($result, $url, $params, array $where = null)
    {
        $total = $this->response->count($where)['total'];
        Page::assemble($result, $total, $this->page, $this->limit);
        list($result['prev'], $result['next']) = Page::simple($result['meta'], $url, $params);
        unset($result['meta']);
        return $result;
    }
}
