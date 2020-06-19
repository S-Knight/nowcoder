<?php

/**
 *调试开关，1为开启，开启则输出一些中间调试信息
 */
define("DEBUG", 0);

class Solution
{
    /**
     * @var array 地图方阵数据
     */
    private $map = [];

    /**
     * @var array x轴的辅助数组
     */
    private $xHelp = [];

    /**
     * @var array y轴的辅助数组
     */
    private $yHelp = [];

    /**
     * @var array 各个位置的距离值
     */
    private $distances = [];

    private $num = 0;

    /**
     * @var int 房子数量，即矩阵中1的总数
     */
    private $house = 0;

    public function __construct()
    {
        $this->init();
        $this->calDistances();
    }

    private function initHelp()
    {
        for ($i = 0; $i < $this->num; $i++) {
            $this->xHelp[$i] = [];
            $this->yHelp[$i] = [];

            for ($j = 0; $j < $this->num; $j++) {
                $this->xHelp[$i][$j] = 0;
                $this->yHelp[$i][$j] = 0;
            }
        }
    }

    private function initDistances()
    {
        for ($i = 0; $i < $this->num; $i++) {
            $this->distances[$i] = [];

            for ($j = 0; $j < $this->num; $j++) {
                $this->distances[$i][$j] = 0;
            }
        }
    }

    private function init()
    {
        $this->getInput();

        $this->initHelp();
        $this->initDistances();

        //将数据类型转成整形，php是弱类型语言，担心留坑
        for ($i = 0; $i < $this->num; $i++) {
            for ($j = 0; $j < $this->num; $j++) {
                $this->map[$i][$j] = intval($this->map[$i][$j]);

                if ($this->map[$i][$j] === 1) {
                    $this->house++;

                    $this->markXHelp($i);
                    $this->markYHelp($j);
                }
            }
        }
    }

    /**
     * 计算坐标(i1,j1)到坐标(i2,j2)的距离
     * @param int $i1
     * @param int $j1
     * @param int $i2
     * @param int $j2
     */
    private function getDistance($i1, $j1, $i2, $j2)
    {
        return abs($i1 - $i2) + abs($j1 - $j2);
    }

    /**
     * 计算$i $j位置区域到各个房子之间的距离和
     * @param int $blankI 空地坐标i
     * @param int $blankJ 空地坐标j
     */
    private function getDistanceSum($blankI, $blankJ)
    {
        $sum = 0;
        for ($i = 0; $i < $this->num; $i++) {
            for ($j = 0; $j < $this->num; $j++) {
                if ($this->map[$i][$j] === 1) {
                    $sum += $this->getDistance($blankI, $blankJ, $i, $j);
                }
            }
        }

        return $sum;
    }

    /**
     * 如果X轴$i位置有房子，则xHelp数组大于等于位$houseI置的元素值都需要加1
     * @param $houseI
     */
    private function markXHelp($houseI)
    {
        for ($i = $houseI; $i < $this->num; $i++) {
            for ($j = 0; $j < $this->num; $j++) {
                $this->xHelp[$i][$j]++;
            }
        }
    }

    private function markYHelp($houseJ)
    {
        for ($i = 0; $i < $this->num; $i++) {
            for ($j = $houseJ; $j < $this->num; $j++) {
                $this->yHelp[$i][$j]++;
            }
        }
    }

    private function getInput()
    {
        fscanf(STDIN, "%d", $this->num);

        for ($i = 0; $i < $this->num; $i++) {
            $input = fgets(STDIN);
            $this->map[$i] = explode(' ', $input);
        }
    }

    private function calDistances()
    {
        $this->distances[0][0] = $this->getDistanceSum(0, 0);

        for ($i = 0; $i < $this->num; $i++) {
            if ($i > 0) {
                $this->distances[$i][0] = $this->distances[$i - 1][0] + 2 * $this->xHelp[$i - 1][0] - $this->house;
            }

            for ($j = 1; $j < $this->num; $j++) {
                $this->distances[$i][$j] = $this->distances[$i][$j - 1] + 2 * $this->yHelp[$i][$j - 1] - $this->house;
            }
        }
    }

    /**
     * 根据矩阵数据，计算最小的距离和
     * @return int
     */
    public function getMinDistSum()
    {
        $shortDist = -1;//最小距离和

        for ($i = 0; $i < $this->num; $i++) {
            for ($j = 0; $j < $this->num; $j++) {
                if ($this->map[$i][$j] === 0) {
                    $distance = $this->distances[$i][$j];

                    if (constant('DEBUG') == 1) {
                        echo $i . " " . $j . ":" . $distance . "\n";
                    }

                    if ($distance < $shortDist || $shortDist === -1) {
                        $shortDist = $distance;
                    }
                }
            }
        }

        return $shortDist;
    }
}

$solution = new Solution();
$minDistSum = $solution->getMinDistSum();
echo $minDistSum . "\n";