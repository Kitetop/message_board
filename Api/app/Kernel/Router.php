<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: 0.1
 * Date: 2018/10/2
 */

namespace App\Kernel;

use Kite\Http\BaseRouter;

/**
 * 路由类，路由设置在当前类中
 * Class Router
 * @package App\Kernel
 */
class Router extends BaseRouter
{
    /**
     * Router constructor.
     * @param $config [框架的配置信息]
     */
    public function __construct($config)
    {
        parent::__construct($this->routers(),$config);
    }

    /**
     * @return Array 自定义的路由
     */
    public function routers()
    {
        $routers = [
            ['path' => '/login', 'action' => 'Login', 'method' => 'POST'],
            ['path' => '/user/register', 'action' => 'User\Register', 'method' => 'POST'],
            ['path' => '/user/info', 'action' => 'User\UserInfo', 'method' => 'GET'],

            //admin的相关接口
            ['path' => '/admin/active', 'action' => 'Admin\BanOrRelUser', 'method' => 'GET'],
            ['path' => '/report/list', 'action' => 'Admin\ReportList', 'method' => 'GET'],

            //帖子的相关操作
            ['path' => '/theme/add', 'action' => 'User\AddTheme', 'method' => 'POST'],
            ['path' => '/theme/list', 'action' => 'User\ThemeList', 'method' => 'GET'],
            ['path' => '/theme/details', 'action' => 'User\ThemeDetails', 'method' => 'GET'],

            //回复的相关接口
            ['path' => '/response/add', 'action' => 'User\AddResponse', 'method' => 'POST'],
            ['path' => '/response/flist', 'action' => 'User\ResFatherList', 'method' => 'GET'],
            ['path' => '/response/clist', 'action' => 'User\ResChildList', 'method' => 'GET'],
            ['path' => '/response/action', 'action' => 'User\ResAgrOrRep', 'method' => 'GET'],
        ];
        return $routers;
    }
}
