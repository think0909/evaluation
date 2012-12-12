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

function utf8substr($sourcestr, $cutlength)
{
    $returnstr = '';
    $i = 0;
    $n = 0;
    $strlength = strlen($sourcestr); //length of source string
    while (($n < $cutlength) and ($i < $strlength)) {
        $temp_str = substr($sourcestr, $i, 1); //get current bit
        $ascnum = Ord($temp_str); //get the ASCII of $ith char in string
        if ($ascnum >= 252) //ASCII code >= 252
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 6); //by UTF-8 encoding standards, 3 continuous bytes counts as 1 word
            $i += 6; //real length is 6
            $n += 2; //count 2 chars
        } elseif ($ascnum >= 248) //ASCII code >= 248
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 5); //by UTF-8 encoding standards, 5 continuous bytes counts as 1 word
            $i += 5; //real length is 5
            $n += 2; //count 2 chars
        } elseif ($ascnum >= 240) //ASCII code >= 240
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 4); //by UTF-8 encoding standards, 4 continuous bytes counts as 1 word
            $i += 4; //real length is 4
            $n += 2; //count 2 chars
        } elseif ($ascnum >= 224) //ASCII code >= 224
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 3); //by UTF-8 encoding standards, 3 continuous bytes counts as 1 word
            $i += 3; //real length is 3
            $n += 2; //count 2 chars
        } elseif ($ascnum >= 192) //ASCII code >= 192
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 2); //by UTF-8 encoding standards, 2 continuous bytes counts as 1 word
            $i += 2; //real length is 2
            $n += 2; //count 2 chars
        } else //ASCII code < 192
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 1); //by UTF-8 encoding standards, 1 byte counts as 1 char
            $i++; //real length is 1
            $n++; //count 1 char
        }
    }
    if ($i < $strlength) //cut
        $returnstr = $returnstr . "..."; //add "..." when being cut
    return $returnstr;
}

