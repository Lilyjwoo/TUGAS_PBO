<?php
$nilai = 75;

if ($nilai >= 85) {
    echo "Nilai Anda: A - Sangat Memuaskan";
} elseif ($nilai >= 75) {
    echo "Nilai Anda: B - Memuaskan";
} elseif ($nilai >= 60) {
    echo "Nilai Anda: C - Cukup";
} else {
    echo "Nilai Anda: D - Tidak Lulus";
}
?>