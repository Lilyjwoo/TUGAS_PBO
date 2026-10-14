<?php
$nama = "Raihannisa Fadhilah";
$nim = "2530521009";
$kelas = "3A";
$prodi = "Teknik Informatika";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Mahasiswa</title>

    <style>
        body {
            font-family: 'Courier New', Courier, monospace, sans-serif;
            background-color: #34577a;
            margin: 0;
            padding: 40px 20px;
        }

        .kartu {
            max-width: 450px;
            margin: auto;
            padding: 25px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 2, 0.1);
        }

        h2 {
            text-align: center;
            color: #2457a7;
            margin-top: 0;
        }

        .data {
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }

        .data:last-child {
            border-bottom: none;
        }

        .label {
            display: inline-block;
            width: 125px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="kartu">
        <h2>Biodata Mahasiswa</h2>

        <div class="data">
            <span class="label">Nama</span>:
            <?= htmlspecialchars($nama) ?>
        </div>

        <div class="data">
            <span class="label">NIM</span>:
            <?= htmlspecialchars($nim) ?>
        </div>

        <div class="data">
            <span class="label">Kelas</span>:
            <?= htmlspecialchars($kelas) ?>
        </div>

        <div class="data">
            <span class="label">Program Studi</span>:
            <?= htmlspecialchars($prodi) ?>
        </div>
    </div>

</body>

</html>