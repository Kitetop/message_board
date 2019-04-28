<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-28
 */

namespace app\Service\User;


use app\Service\Common\ResponseFunc;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class ResChildList extends AbstractService
{
    protected function execute()
    {
        $response = new ResponseFunc($this->id, $this->limit, $this->page);
        $result = $response->findChild();
        $result = $this->call('Common\ResponseData',[
            'result' => $result
        ]);
        $where = ['father_id' => $this->id];
        $url = $this->config['rootUrl'] . '/response/clist?';
        $result = $response->getReturn($result, $url, $this->params, $where);
        return Response::success(null, $result);
    }
}
