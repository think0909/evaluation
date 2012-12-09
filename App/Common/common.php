<?php
/**
 * Created by JetBrains PhpStorm.
 * User: chengs
 * Date: 12-12-9
 * Time: 下午7:46
 * To change this template use File | Settings | File Templates.
 */

//公共函数库

//point默认为true时，表示类似1.000也判断为整数,false判断1.000为非整数
function isInt($num, $point = true)
{
    if ($point) {
        $num = rtrim($num, 0);
        $num = $num * 1;
    }

    return is_int($num);
}

function displayWeight($weight)
{
    return isInt($weight) ? number_format($weight, 0) : number_format($weight, 2);
}
