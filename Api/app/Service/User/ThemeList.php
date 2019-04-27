<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-27
 */

namespace App\Service\User;


use App\Model\MessageTheme;
use Kite\Commons\Page;
use Kite\Commons\Response;
use Kite\Service\AbstractService;

class ThemeList extends AbstractService
{
    private $theme;

    protected function execute()
    {
        $this->theme = new MessageTheme();
        $result = null;
        $total = $this->theme->count()['total'];
        if($this->type == 0) {
            $result = $this->findByNum();
        } else {
            $result = $this->findByTime();
        }
        $url = $this->config['rootUrl'] . '/theme/list?';
        Page::assemble($result, $total, $this->page, $this->limit);
        list($result['prev'], $result['next']) = Page::simple($result['meta'], $url, $this->params);
        unset($result['meta']);
        return Response::success(null, $result);
    }

    /**
     * @return mixed
     * 根据回复的数量来确定最热门的帖子
     */
    private function findByNum()
    {
        return $this->theme->find()
            ->order(['response_num' => 'DESC'])
            ->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function findByTime()
    {
        return $this->theme->find()
            ->order(['time' => 'DESC'])
            ->page(($this->page - 1) * $this->limit, $this->limit)
            ->execute()->fetchAll(\PDO::FETCH_ASSOC);
    }
}
