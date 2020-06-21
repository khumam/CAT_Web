<?php

function countTetha($bi)
{
    $d = 1.7;
    $a = 1;
    $bi = (float) $bi;
    $count = $bi + (1 / $d * $a) * (log(0.5 * (1 + sqrt(1))));
    return $count;
}

function countPi($tetha, $bi)
{
    $pangkat = (float) $tetha - (float) $bi;
    $count = exp($pangkat) / (1 + exp($pangkat));
    return $count;
}

function countQi($pi)
{
    $count = 1 - ((float) $pi);
    return $count;
}

function countLi($pi, $qi)
{
    $count = (float) $pi * (float) $qi;
    return $count;
}

function  countSE($li)
{
    $totalLi = 0;
    for ($i = 0; $i < count($li); $i++) {
        $totalLi += (float) $li[$i];
    }
    $count = 1 / (sqrt($totalLi));
    return $count;
}
