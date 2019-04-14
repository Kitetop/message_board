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
            ['path' => '/login', 'action' => 'User\Login', 'method' => 'POST'],
            ['path' => '/register', 'action' => 'User\Register', 'method' => 'POST'],
            ['path' => '/index', 'action' => 'Index', 'method' => 'GET'],
            ['path' => '/news/user/:id', 'action' => 'Index', 'method' => 'GET'],
            ['path' => '/news/:name', 'action' => 'Index', 'method' => 'GET'],
            ['path' => '/news/user/:username/:password', 'action' => 'Index', 'method' => 'GET'],
        ];
        return $routers;
    }
}
