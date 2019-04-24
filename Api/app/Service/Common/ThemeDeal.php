<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-24
 */

namespace App\Service\Common;


use App\Model\MessageTheme;

final class ThemeDeal
{
    public function findResponse($theme)
    {
        $model = new MessageTheme(['id' => $theme]);
    }
}
