<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lijun
 * Date: 12-12-1
 * Time: 下午3:04
 * To change this template use File | Settings | File Templates.
 */

/* the posibility of $s1 >= $s2

    where array $s1 and $s2 have three componts: l, m, u which refer to 0,1,2.
*/

function compare($s1, $s2){
    return ($s2[0]-$s1[2])/(($s1[1]-$s1[2])-($s2[1]-$s2[0]));
}

function weight($s){
    $length = count($s);
    for($i=0; $i<$length;$i++){
        if(count($s[$i]) != $length) return null;
    }
    for($k=0;$k<3;$k++){
        $sum[$k] = 0;
        for($i=0; $i<$length;$i++){
            $item[$i][$k] = 0;
            for($j=0; $j<$length;$j++){
                $item[$i][$k]+=$s[$i][$j][$k];
            }
            $sum[$k]+=$item[$i][$k];
        }
    }
    for($k=0;$k<3;$k++){
        for($i=0; $i<$length;$i++){
            $item[$i][$k] = $item[$i][$k]/$sum[2-$k];
        }
    }
    $result_sum = 0;
    for($i=0; $i<$length;$i++){
        $result[$i] = 100;
        for($j=0; $j<$length;$j++){
            if($j == $i) continue;
            $result[$i] = (compare($item[$i],$item[$j])<$result[$i]) ? compare($item[$i],$item[$j]): $result[$i];
        }
        $result_sum += $result[$i];
    }

    for($i=0;$i<$length;$i++){
        $result[$i] =  $result[$i]/$result_sum;
    }
    return $result;
}

$s = array(
    array(
        array(1,1,1),
        array(4,6,8),
        array(1/8,1/6,1/4),
        array(1,3,5)),
    array(
        array(1/8,1/6,1/4),
        array(1,1,1),
        array(1,3,5),
        array(1/5,1/3,1)),
    array(
        array(4,6,8),
        array(1/5,1/3,1),
        array(1,1,1),
        array(3,5,7)),
    array(
        array(1/5,1/3,1),
        array(3,5,7),
        array(1/7,1/5,1/3),
        array(1,1,1))
);
$re = weight($s);

echo($re[0] . "<br/>");
echo($re[1] . "<br/>");
echo($re[2] . "<br/>");
echo($re[3] . "<br/>");
?>



md5('aaa')=