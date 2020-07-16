<?php
/*
   思路:
   穷举法，不符合题目O（N）时间复杂度的要求，仅仅是玩一下
   设该数组为array,元素分别为a1，a2...an,用一个二维数组记录下ai到an的和。
*/

/*
    用来存放和的结果，是一个二维数组，$sum[i][j]表示ai加到aj的和
    例如：$sum[1][5]表示a1+a2+...+a5的和
*/

$sum = [];

if (fscanf(STDIN, "%d", $N) == 1) {
    $sum[1] = [];
    $sum[1][0] = 0;

    for ($i = 1; $i <= $N; $i++) {
        fscanf(STDIN, "%d", $num);

        $sum[$i] = [];
        $sum[$i][$i - 1] = 0;

        for ($j = 1; $j <= $i; $j++) {
            $sum[$j][$i] = $sum[$j][$i - 1] + $num;
        }
    }

    //在数组中查找最大值
    $maxSum = $sum[1][1];
    for ($i = 1; $i <= $N; $i++) {
        for ($j = $i; $j <= $N; $j++) {
            if ($sum[$i][$j] > $maxSum) {
                $maxSum = $sum[$i][$j];
            }
        }
    }

    echo $maxSum . "\n";
}