<?php
// 1. Data mahasiswa
$nama = "Raihannisa Fadhilah";
$nim = "2530521009";
$kelas = "3A";
$prodi = "Teknik Informatika";
$fakultas = "Sains dan Teknologi";

$nilai_tugas = 85;
$nilai_uts = 80;
$nilai_uas = 90;
$status_aktif = true;

// 2. Function untuk menghitung nilai akhir
function hitungNilai($tugas, $uts, $uas)
{
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Menghitung nilai akhir
$nilai_akhir = hitungNilai(
    $nilai_tugas,
    $nilai_uts,
    $nilai_uas
);

// 4. Percabangan untuk menentukan predikat
if ($nilai_akhir >= 85) {
    $predikat = "A";
    $keterangan = "Sangat Baik";
} elseif ($nilai_akhir >= 75) {
    $predikat = "B";
    $keterangan = "Baik";
} elseif ($nilai_akhir >= 65) {
    $predikat = "C";
    $keterangan = "Cukup";
} else {
    $predikat = "D";
    $keterangan = "Kurang";
}

// 5. Data nilai untuk ditampilkan melalui perulangan
$daftar_nilai = [
    "Nilai Tugas" => $nilai_tugas,
    "Nilai UTS" => $nilai_uts,
    "Nilai UAS" => $nilai_uas
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Nilai Mahasiswa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #eaf3ff, #f8fbff);
            color: #172b4d;
            min-height: 100vh;
        }

        .hero {
            background: linear-gradient(120deg, #c8e0ff, #edf6ff, #b7d5ff);
            padding: 45px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero h1 {
            font-size: clamp(25px, 4vw, 38px);
            color: #164b91;
            margin-bottom: 10px;
        }

        .hero p {
            color: #526985;
            font-size: 16px;
        }

        .container {
            max-width: 1050px;
            margin: 30px auto;
            padding: 0 18px;
            animation: muncul 0.8s ease;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid #d7e7ff;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(38, 95, 160, 0.08);
        }

        .section-title {
            color: #174b8c;
            font-size: 21px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .profile-item {
            background: #f3f8ff;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #e0ecff;
            overflow-wrap: anywhere;
        }

        .profile-item span {
            display: block;
            font-size: 13px;
            color: #6b7f99;
            margin-bottom: 6px;
        }

        .profile-item strong {
            font-size: 15px;
        }

        .grade-layout {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 22px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 280px;
        }

        th {
            background: #1f5da8;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e3edfa;
        }

        tbody tr:hover {
            background: #f0f6ff;
            transition: 0.2s;
        }

        .score-box {
            margin-top: 20px;
            padding: 22px;
            border-radius: 15px;
            background: linear-gradient(120deg, #e5f0ff, #d0e5ff);
            border: 1px solid #c7ddff;
        }

        .score-box span {
            color: #47678f;
            font-size: 14px;
        }

        .score {
            font-size: 43px;
            font-weight: 800;
            color: #174b91;
            margin-top: 5px;
        }

        .result-card {
            text-align: center;
            background: linear-gradient(145deg, #e8f3ff, #f5f9ff);
        }

        .medal {
            width: 105px;
            height: 105px;
            margin: 0 auto 15px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: linear-gradient(145deg, #ffdf70, #ffb51c);
            color: white;
            font-size: 54px;
            font-weight: 800;
            box-shadow: 0 7px 20px #f6d16d80;
            animation: mengambang 3s ease-in-out infinite;
        }

        .result-card h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .result-card .predikat {
            font-size: 55px;
            font-weight: 800;
            color: #1e60ad;
        }

        .badge {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 18px;
            border-radius: 30px;
            background: #d7f7e8;
            color: #087c54;
            font-weight: 700;
        }

        .legend {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #d8e7f7;
            text-align: left;
        }

        .legend h3 {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .legend p {
            margin: 10px 0;
            font-size: 14px;
        }

        .grade-label {
            display: inline-grid;
            place-items: center;
            width: 29px;
            height: 29px;
            border-radius: 50%;
            color: white;
            font-weight: bold;
            margin-right: 8px;
        }

        .a {
            background: #16a77a;
        }

        .b {
            background: #3688ee;
        }

        .c {
            background: #f5ac28;
        }

        .d {
            background: #ed5367;
        }

        footer {
            text-align: center;
            padding: 25px 15px;
            color: #55749c;
            font-size: 14px;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes mengambang {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        @media (max-width: 700px) {
            .grade-layout {
                grid-template-columns: 1fr;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 18px;
            }

            .hero {
                padding: 35px 15px;
            }
        }
    </style>
</head>

<body>

    <header class="hero">
        <h1>🎓 Hasil Perhitungan Nilai Mahasiswa</h1>
        <p>Informasi nilai akademik dan predikat mahasiswa</p>
    </header>

    <main class="container">

        <section class="card">
            <h2 class="section-title">👤 Identitas Mahasiswa</h2>

            <div class="profile-grid">
                <div class="profile-item">
                    <span>Nama Lengkap</span>
                    <strong>
                        <?= htmlspecialchars($nama) ?>
                    </strong>
                </div>

                <div class="profile-item">
                    <span>Nomor Induk Mahasiswa</span>
                    <strong>
                        <?= htmlspecialchars($nim) ?>
                    </strong>
                </div>

                <div class="profile-item">
                    <span>Kelas</span>
                    <strong>
                        <?= htmlspecialchars($kelas) ?>
                    </strong>
                </div>

                <div class="profile-item">
                    <span>Program Studi</span>
                    <strong>
                        <?= htmlspecialchars($prodi) ?>
                    </strong>
                </div>

                <div class="profile-item">
                    <span>Fakultas</span>
                    <strong>
                        <?= htmlspecialchars($fakultas) ?>
                    </strong>
                </div>
            </div>
        </section>

        <div class="grade-layout">

            <section class="card">
                <h2 class="section-title">📚 Rincian Nilai</h2>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Nilai</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nomor = 1;

                            foreach ($daftar_nilai as $jenis => $nilai) {
                                echo "<tr>";
                                echo "<td>" . $nomor . "</td>";
                                echo "<td>" . htmlspecialchars($jenis) . "</td>";
                                echo "<td><strong>" . $nilai . "</strong></td>";
                                echo "</tr>";

                                $nomor++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="score-box">
                    <span>Nilai Akhir Mahasiswa</span>
                    <div class="score">
                        <?= number_format($nilai_akhir, 2) ?>
                    </div>
                    <span>Bobot: Tugas 30% · UTS 30% · UAS 40%</span>
                </div>
            </section>

            <section class="card result-card">
                <div class="medal">
                    <?= htmlspecialchars($predikat) ?>
                </div>

                <h2>Predikat Akademik</h2>
                <div class="predikat">
                    <?= htmlspecialchars($predikat) ?>
                </div>

                <p>
                    <?= htmlspecialchars($keterangan) ?>
                </p>

                <div class="badge">
                    ● Status Aktif:
                    <?= $status_aktif ? "Ya" : "Tidak" ?>
                </div>

                <div class="legend">
                    <h3>📊 Keterangan Predikat</h3>
                    <p><span class="grade-label a">A</span> 85–100 (Sangat Baik)</p>
                    <p><span class="grade-label b">B</span> 75–84,99 (Baik)</p>
                    <p><span class="grade-label c">C</span> 65–74,99 (Cukup)</p>
                    <p><span class="grade-label d">D</span> Di bawah 65 (Kurang)</p>
                </div>
            </section>

        </div>

    </main>

    <footer>
        <p>✨ Terus belajar dan raih masa depan yang lebih baik! ✨</p>
        <p>Program Perhitungan Nilai Mahasiswa · PHP</p>
    </footer>

</body>

</html>