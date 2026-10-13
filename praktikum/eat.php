
<?php
// =====================================
// 1. VARIABEL DAN DATA MAKANAN
// =====================================

$namaProgram = "What Should I Eat Today?";
$budget = 0;
$waktuMakan = "Siang";
$uangTersisa = 0.0;

$daftarMakanan = [
    ["nama" => "Nasi Goreng", "harga" => 15000, "waktu" => "Malam"],
    ["nama" => "Nasi Kuning", "harga" => 10000, "waktu" => "Pagi"],
    ["nama" => "Mie Ayam", "harga" => 12000, "waktu" => "Siang"],
    ["nama" => "Bubur Ayam", "harga" => 10000, "waktu" => "Pagi"],
    ["nama" => "Nasi Ayam", "harga" => 18000, "waktu" => "Siang"],
    ["nama" => "Roti dan Susu", "harga" => 8000, "waktu" => "Pagi"],
    ["nama" => "Seblak", "harga" => 13000, "waktu" => "Malam"],
    ["nama" => "Nasi Padang", "harga" => 20000, "waktu" => "Siang"]
];

// =====================================
// 2. FUNGSI BUATAN SENDIRI
// =====================================

function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

function hitungSisaUang($budget, $harga) {
    return $budget - $harga;
}

// =====================================
// 3. MENGAMBIL DATA FORM POST
// =====================================

$hasil = [];
$pesan = "";
$budgetInput = "";
$waktuInput = "Siang";
$sudahDikirim = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sudahDikirim = true;

    $budgetInput = $_POST["budget"] ?? "";
    $waktuInput = $_POST["waktu"] ?? "Siang";

    if (is_numeric($budgetInput) && $budgetInput > 0) {
        $budget = (float) $budgetInput;

        // =====================================
        // 4. PERCABANGAN
        // =====================================

        if ($budget < 10000) {
            $pesan = "Budget kamu terbatas. Coba cari camilan atau makanan sederhana.";
        } elseif ($budget < 20000) {
            $pesan = "Tenang, masih ada beberapa pilihan makanan yang cocok!";
        } else {
            $pesan = "Budget kamu cukup fleksibel. Yuk, pilih makanan favoritmu!";
        }

        // =====================================
        // 5. PERULANGAN UNTUK FILTER MAKANAN
        // =====================================

        foreach ($daftarMakanan as $makanan) {
            if (
                $makanan["harga"] <= $budget &&
                $makanan["waktu"] == $waktuInput
            ) {
                $hasil[] = $makanan;
            }
        }

    } else {
        $pesan = "Masukkan budget berupa angka yang lebih besar dari nol.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What Should I Eat Today?</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #fff1e6, #ffe0cc);
            color: #3c2a21;
            padding: 30px 15px;
        }

        .container {
            max-width: 760px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            animation: muncul 0.7s ease;
        }

        .header .emoji {
            font-size: 55px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 30px;
            color: #b84a28;
            margin-bottom: 10px;
        }

        .header p {
            color: #795548;
            line-height: 1.6;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(90, 50, 20, 0.10);
            animation: muncul 0.8s ease;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #9c4225;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 15px 0 8px;
        }

        input, select {
            width: 100%;
            padding: 13px;
            border: 1px solid #e3c7b7;
            border-radius: 10px;
            font-size: 15px;
            background: #fffaf7;
        }

        input:focus, select:focus {
            outline: 2px solid #e99a72;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 22px;
            border: none;
            border-radius: 10px;
            background: #c65d36;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #a84525;
            transform: translateY(-2px);
        }

        .pesan {
            padding: 15px;
            border-radius: 10px;
            background: #fff0df;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .food-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 14px;
        }

        .food-item {
            padding: 17px;
            background: #fff8f3;
            border: 1px solid #f1d8c8;
            border-radius: 14px;
            transition: 0.3s;
        }

        .food-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px rgba(90, 50, 20, 0.10);
        }

        .food-item .icon {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .food-item h3 {
            margin-bottom: 8px;
            font-size: 17px;
        }

        .harga {
            color: #b84a28;
            font-weight: bold;
        }

        .sisa {
            margin-top: 20px;
            padding: 17px;
            background: #e9f8e9;
            color: #27632a;
            border-radius: 12px;
            line-height: 1.7;
        }

        .kosong {
            padding: 20px;
            text-align: center;
            background: #fff8f3;
            border-radius: 12px;
            line-height: 1.7;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #795548;
            padding: 10px;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 25px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <header class="header">
        <div class="emoji">🍜</div>
        <h1>What Should I Eat Today?</h1>
        <p>Bingung mau makan apa? Sesuaikan pilihan makananmu<br>
        dengan budget yang kamu punya!</p>
    </header>

    <section class="card">
        <h2>💰 Atur Budget Makan</h2>

        <form method="POST" action="">
            <label for="budget">Budget kamu (Rupiah)</label>
            <input
                type="number"
                id="budget"
                name="budget"
                min="1"
                placeholder="Contoh: 15000"
                value="<?= htmlspecialchars((string)$budgetInput) ?>"
                required
            >

            <label for="waktu">Kamu mau makan kapan?</label>
            <select id="waktu" name="waktu" required>
                <option value="Pagi"
                    <?= $waktuInput == "Pagi" ? "selected" : "" ?>>
                    🌅 Sarapan
                </option>

                <option value="Siang"
                    <?= $waktuInput == "Siang" ? "selected" : "" ?>>
                    ☀️ Makan siang
                </option>

                <option value="Malam"
                    <?= $waktuInput == "Malam" ? "selected" : "" ?>>
                    🌙 Makan malam
                </option>
            </select>

            <button type="submit">Cari Makanan 🍽️</button>
        </form>
    </section>

    <?php if ($sudahDikirim): ?>

        <section class="card">
            <h2>✨ Hasil Rekomendasi</h2>

            <div class="pesan">
                <?= htmlspecialchars($pesan) ?>
            </div>

            <?php if (is_numeric($budgetInput) && $budget > 0): ?>

                <p style="margin-bottom: 18px;">
                    Budget kamu:
                    <strong><?= formatRupiah($budget) ?></strong>
                </p>

                <?php if (count($hasil) > 0): ?>

                    <div class="food-list">

                        <?php foreach ($hasil as $makanan): ?>
                            <div class="food-item">
                                <div class="icon">🍽️</div>

                                <h3>
                                    <?= htmlspecialchars($makanan["nama"]) ?>
                                </h3>

                                <p class="harga">
                                    <?= formatRupiah($makanan["harga"]) ?>
                                </p>

                                <div class="sisa">
                                    Sisa uang jika membeli makanan ini:
                                    <strong>
                                        <?= formatRupiah(
                                            hitungSisaUang(
                                                $budget,
                                                $makanan["harga"]
                                            )
                                        ) ?>
                                    </strong>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="kosong">
                        😥 Belum ada makanan dalam daftar yang cocok
                        dengan budget dan waktu makanmu.
                        <br>
                        Coba tambah budget atau pilih waktu makan lain.
                    </div>

                <?php endif; ?>

            <?php else: ?>

                <div class="kosong">
                    Silakan masukkan budget yang valid, misalnya 15000.
                </div>

            <?php endif; ?>
        </section>

    <?php endif; ?>

    <footer class="footer">
        <p>Made for everyday student life ❤️</p>
        <p>Program sederhana menggunakan PHP, HTML, dan CSS.</p>
    </footer>

</div>
</body>
</html>
