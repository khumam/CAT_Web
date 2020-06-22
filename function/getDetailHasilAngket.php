<?php

require '../function/db_connect.php';

function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

$detailAngket = mysqli_query($db, 'SELECT * FROM cat_angket');
$hasilAngket = mysqli_query($db, 'SELECT * FROM cat_hasil_angket');
$listDetailAngket = [];
$listHasilAngket = [];

while ($detail = mysqli_fetch_assoc($detailAngket)) {
    $listDetailAngket[] = $detail;
}
while ($hasil = mysqli_fetch_assoc($hasilAngket)) {
    $listHasilAngket[] = $hasil;
}

$skorAngket = [];

foreach ($listDetailAngket as $lda) {
    $skorAngket[$lda['id']]['1']['data'] = 0;
    $skorAngket[$lda['id']]['2']['data'] = 0;
    $skorAngket[$lda['id']]['3']['data'] = 0;
    $skorAngket[$lda['id']]['4']['data'] = 0;
    $skorAngket[$lda['id']]['1']['color'] = rand_color();
    $skorAngket[$lda['id']]['2']['color'] = rand_color();
    $skorAngket[$lda['id']]['3']['color'] = rand_color();
    $skorAngket[$lda['id']]['4']['color'] = rand_color();
}

foreach ($listHasilAngket as $lha) {
    $skorAngket[$lha['angket_id']][$lha['jawaban']]['data'] += 1;
}
