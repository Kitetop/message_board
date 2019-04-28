<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace app\Service\User;

use app\Service\Common\ResponseFunc;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

/**
 * Class ResponseList
 * @package app\Service\User
 * 显示帖子的直系留言
 */
class ResFatherList extends AbstractService
{
    protected function execute()
    {
        $response = new ResponseFunc($this->id, $this->limit, $this->page);
        $result = $response->findFather();
        $result = $this->call('Common\ResponseData',[
            'result' => $result
        ]);
        $where = ['theme_id' => $this->id, 'father_id' => 0];
        $url = $this->config['rootUrl'] . '/response/flist?';
        $result = $response->getReturn($result, $url, $this->params, $where);
        return Response::success(null, $result);
    }
}
