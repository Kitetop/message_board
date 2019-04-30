<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-30
 */

namespace app\Service\Admin;

use App\Model\MessageUser;
use app\Service\Common\ResponseFunc;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class ReportList extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $admin = new MessageUser(['id' => $this->id]);
        if($admin->status != MessageUser::ADMINER) {
            return Response::error(400, '没有权限查看');
        }
        $where = $this->getwhere($this->type);
        $response = new ResponseFunc(null, $this->limit, $this->page);
        $result = $response->findMostReport($where);
        $result = $this->call('Common\ResponseData',['result' => $result]);
        $url = $this->config['rootUrl'] . '/report/list?';
        $result = $response->getReturn($result, $url, $this->params, $where);
        return Response::success(null, $result);
    }

    /**
     * @param $type
     * @return array
     * 根据type的值来设置检索的留言的范围
     */
    private function getwhere($type)
    {
        if ($type == 0) {
            $date = date('Y-m-d H:i:s', strtotime('-1 day'));

        } elseif ($type == 1) {
            $date = date('Y-m-d H:i:s', strtotime('-1 week'));
        } else {
            $date = date('Y-m-d H:i:s', strtotime('-1 month'));
        }
        return [
            ['time', '>', $date]
        ];
    }
}
