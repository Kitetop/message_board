<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-29
 */

namespace app\Service\User;


use App\Model\MessageResponse;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class ResAgrOrRep extends AbstractService
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $response = new MessageResponse(['id' => $this->id]);
        if (!$response->exist()) {
            return Response::error(400, '留言不存在');
        }
        $this->type == 0 && $this->agreeRes($response);
        $this->type == 1 && $this->reportRes($response);
        return Response::success('感谢你的参与');
    }

    private function reportRes(MessageResponse $response)
    {
        $response->report += 1;
        $response->save();
    }

    private function agreeRes(MessageResponse $response)
    {
        $response->agree += 1;
        $response->save();
    }
}
