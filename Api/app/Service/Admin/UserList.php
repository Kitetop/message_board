<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release:
 * Date: 2019-06-04
 */

namespace app\Service\Admin;


use App\Model\MessageUser;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class UserList extends AbstractService
{
    protected function execute()
    {
        $admin = new MessageUser(['id' => $this->id]);
        if ($admin->status != MessageUser::ADMINER) {
            return Response::error(400, '没有权限查看');
        }
        $where = $this->getWhere();
        $user = new MessageUser();
        $result = $user->find()->where($where)->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
        $this->formData($result);
        $result['total'] = $user->count($where)['total'];
        return Response::success('查找成功', $result);

    }

    /**
     * @return array
     * 生成查询条件
     */
    private function getWhere()
    {
        if($this->query == -1) {
            return ['active' => $this->active];
        } else {
            return ['active' => $this->active, ['account', 'like', '%'. $this->query. '%']];
        }
    }

    /**
     * @param $result
     * 设置返回数据格式
     */
    private function formData(&$result)
    {
        foreach ($result as &$value) {
            $value['sex'] == 0 && $value['sex'] = '女';
            $value['sex'] == 1 && $value['sex'] = '男';
            unset($value['password']);
            $value['active'] == 0 && $value['active'] = '正常';
            $value['active'] == 1 && $value['active'] = '封禁';
            $value['image'] = $this->config['imageUrl'] . $value['image'];
            $value['status'] == 1 && $value['status'] ='管理员';
            $value['status'] == 2 && $value['status'] ='会员';
        }
    }
}
