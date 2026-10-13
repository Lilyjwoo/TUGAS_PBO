<?php
// ============================================
// 1. DATA MENU DAN HARGA
// ============================================

$menuMakanan = [
    "Nasi Goreng" => 15000,
    "Mie Ayam" => 12000,
    "Ayam Geprek" => 18000,
    "Nasi Goreng Spesial" => 22000
];

$menuMinuman = [
    "Air Mineral" => 4000,
    "Es Teh" => 5000,
    "Jus Jeruk" => 8000,
    "Kopi Susu" => 10000
];

$menuTopping = [
    "Telur" => 4000,
    "Keju" => 3000,
    "Sosis" => 4000
];

// ============================================
// 2. FUNGSI BUATAN SENDIRI
// ============================================

// Mengubah angka menjadi format rupiah
function rupiah($angka)
{
    return "Rp" . number_format($angka, 0, ",", ".");
}

// Menghitung subtotal makanan, minuman, dan topping
function hitungTotal($hargaMakanan, $hargaMinuman, $hargaTopping, $jumlah)
{
    return ($hargaMakanan + $hargaMinuman + $hargaTopping) * $jumlah;
}

// ============================================
// 3. NILAI AWAL FORM
// ============================================

$nama = "";
$makanan = "Nasi Goreng";
$jumlah = 1;
$minuman = "Es Teh";
$toppingDipilih = ["Telur"];
$pedas = "Sedang";
$jenisPesanan = "Makan di tempat";
$pembayaran = "QRIS";

$errors = [];
$pesananDikirim = false;
$total = 0;
$diskon = 0;
$totalBayar = 0;

// ============================================
// 4. MEMPROSES FORM DENGAN METHOD POST
// ============================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pesananDikirim = true;

    // Mengambil input dari form
    $nama = trim($_POST["nama"] ?? "");
    $makanan = $_POST["makanan"] ?? "";
    $jumlahInput = $_POST["jumlah"] ?? "";
    $minuman = $_POST["minuman"] ?? "";
    $toppingDipilih = $_POST["topping"] ?? [];
    $pedas = $_POST["pedas"] ?? "";
    $jenisPesanan = $_POST["jenis_pesanan"] ?? "";
    $pembayaran = $_POST["pembayaran"] ?? "";

    // ========================================
    // 5. VALIDASI INPUT
    // ========================================

    if ($nama == "") {
        $errors[] = "Nama pemesan wajib diisi.";
    } elseif (strlen($nama) > 100) {
        $errors[] = "Nama maksimal 100 karakter.";
    }

    if (!is_string($makanan) || !array_key_exists($makanan, $menuMakanan)) {
        $errors[] = "Pilihan makanan tidak valid.";
    }

    if (
        !is_string($jumlahInput) ||
        !ctype_digit($jumlahInput) ||
        (int) $jumlahInput < 1 ||
        (int) $jumlahInput > 20
    ) {
        $errors[] = "Jumlah pesanan harus antara 1 sampai 20.";
    } else {
        $jumlah = (int) $jumlahInput;
    }

    if (!is_string($minuman) || !array_key_exists($minuman, $menuMinuman)) {
        $errors[] = "Pilihan minuman tidak valid.";
    }

    if (!is_array($toppingDipilih)) {
        $errors[] = "Format topping tidak valid.";
        $toppingDipilih = [];
    } else {
        // Memastikan semua topping benar-benar tersedia
        foreach ($toppingDipilih as $topping) {
            if (
                !is_string($topping) ||
                !array_key_exists($topping, $menuTopping)
            ) {
                $errors[] = "Terdapat pilihan topping yang tidak valid.";
                break;
            }
        }

        // Menghilangkan pilihan topping yang sama
        $toppingDipilih = array_unique($toppingDipilih);
    }

    $pilihanPedas = ["Tidak pedas", "Sedang", "Pedas", "Extra pedas"];
    $pilihanPesanan = ["Makan di tempat", "Dibungkus", "Antar ke rumah"];
    $pilihanPembayaran = ["Tunai", "QRIS", "Transfer bank"];

    if (!is_string($pedas) || !in_array($pedas, $pilihanPedas, true)) {
        $errors[] = "Pilihan tingkat kepedasan tidak valid.";
    }

    if (
        !is_string($jenisPesanan) ||
        !in_array($jenisPesanan, $pilihanPesanan, true)
    ) {
        $errors[] = "Jenis pesanan tidak valid.";
    }

    if (
        !is_string($pembayaran) ||
        !in_array($pembayaran, $pilihanPembayaran, true)
    ) {
        $errors[] = "Metode pembayaran tidak valid.";
    }

    // ========================================
    // 6. MENGHITUNG TOTAL PESANAN
    // ========================================

    if (empty($errors)) {

        $hargaMakanan = $menuMakanan[$makanan];
        $hargaMinuman = $menuMinuman[$minuman];
        $hargaTopping = 0;

        // Perulangan untuk menjumlahkan harga topping
        foreach ($toppingDipilih as $topping) {
            $hargaTopping += $menuTopping[$topping];
        }

        // Fungsi untuk menghitung total
        $total = hitungTotal(
            $hargaMakanan,
            $hargaMinuman,
            $hargaTopping,
            $jumlah
        );

        // Biaya tambahan untuk layanan antar
        $biayaAntar = 0;

        if ($jenisPesanan == "Antar ke rumah") {
            $biayaAntar = 5000;
        }

        $total += $biayaAntar;

        // ====================================
        // 7. PERCABANGAN DISKON
        // ====================================

        if ($total >= 100000) {
            $diskon = $total * 0.15;
        } elseif ($total >= 50000) {
            $diskon = $total * 0.10;
        } elseif ($total >= 30000) {
            $diskon = $total * 0.05;
        } else {
            $diskon = 0;
        }

        // Menghitung total setelah diskon
        $totalBayar = $total - $diskon;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Order | Pemesanan Makanan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff4e8, #ffe0cc);
            color: #382820;
            min-height: 100vh;
            padding: 30px 15px;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        header {
            text-align: center;
            margin-bottom: 25px;
            animation: muncul 0.7s ease;
        }

        .logo {
            font-size: 55px;
            margin-bottom: 8px;
        }

        header h1 {
            color: #bd542d;
            font-size: 32px;
            margin-bottom: 10px;
        }

        header p {
            color: #795548;
            line-height: 1.6;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(80, 40, 20, 0.09);
            animation: muncul 0.7s ease;
        }

        .card h2 {
            color: #ad4c2a;
            font-size: 21px;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label,
        .label-title {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #e4c9b9;
            border-radius: 10px;
            background: #fffaf7;
            color: #382820;
            font-size: 15px;
        }

        input:focus,
        select:focus {
            outline: 2px solid #e9a07e;
            border-color: #bd542d;
        }

        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 10px 12px;
            background: #fff8f3;
            border: 1px solid #f0d8ca;
            border-radius: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .option input {
            accent-color: #bd542d;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 11px;
            background: #bd542d;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #983e20;
            transform: translateY(-2px);
        }

        .error {
            padding: 15px 18px;
            background: #fff0f0;
            border: 1px solid #ffcaca;
            border-radius: 10px;
            color: #a02020;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .success {
            padding: 16px;
            background: #eaf8ed;
            color: #246b37;
            border-radius: 10px;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 13px 5px;
            border-bottom: 1px solid #f0e4dc;
            vertical-align: top;
            line-height: 1.5;
        }

        .summary-table td:first-child {
            color: #795548;
            width: 42%;
        }

        .summary-table td:last-child {
            text-align: right;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .total-box {
            margin-top: 20px;
            padding: 20px;
            background: #fff4e8;
            border-radius: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 12px;
        }

        .grand-total {
            border-top: 1px dashed #d5a68d;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #bd542d;
        }

        .footer {
            text-align: center;
            padding: 12px;
            font-size: 13px;
            color: #795548;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            header h1 {
                font-size: 25px;
            }

            .card {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .full-width {
                grid-column: auto;
            }

            .summary-table td {
                font-size: 14px;
            }

            .grand-total {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <header>
            <div class="logo">🍔</div>
            <h1>Food Order</h1>
            <p>Pesan makanan favoritmu dengan mudah.<br>
                Pilih menu, atur pesanan, dan lihat total pembayaranmu!</p>
        </header>

        <section class="card">
            <h2>📝 Form Pemesanan</h2>

            <?php if (!empty($errors)): ?>
                <div class="error">
                    <strong>Pesanan belum dapat diproses:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-grid">

                    <div class="form-group full-width">
                        <label for="nama">Nama Pemesan</label>
                        <input type="text" id="nama" name="nama" maxlength="100" placeholder="Masukkan nama kamu"
                            value="<?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?>"
                        required
                        >
                    </div>

                    <div class="form-group">
                        <label for="makanan">Pilih Makanan</label>
                        <select id="makanan" name="makanan" required>
                            <?php foreach ($menuMakanan as $namaMenu => $harga): ?>
                                <option value="<?= htmlspecialchars($namaMenu, ENT_QUOTES, "UTF-8") ?>"
                                    <?= $makanan === $namaMenu ? "selected" : "" ?>
                                    >
                                    <?= htmlspecialchars($namaMenu) ?>
                                    -
                                    <?= rupiah($harga) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah Porsi</label>
                        <input type="number" id="jumlah" name="jumlah" min="1" max="20"
                            value="<?= htmlspecialchars((string) $jumlah) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="minuman">Pilih Minuman</label>
                        <select id="minuman" name="minuman" required>
                            <?php foreach ($menuMinuman as $namaMenu => $harga): ?>
                                <option value="<?= htmlspecialchars($namaMenu, ENT_QUOTES, "UTF-8") ?>"
                                    <?= $minuman === $namaMenu ? "selected" : "" ?>
                                    >
                                    <?= htmlspecialchars($namaMenu) ?>
                                    -
                                    <?= rupiah($harga) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pedas">Tingkat Kepedasan</label>
                        <select id="pedas" name="pedas" required>
                            <?php foreach (
                                ["Tidak pedas", "Sedang", "Pedas", "Extra pedas"]
                                as $pilihan
                            ): ?>
                                <option value="<?= htmlspecialchars($pilihan) ?>" <?= $pedas === $pilihan ? "selected" : "" ?>
                                    >
                                    <?= htmlspecialchars($pilihan) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <span class="label-title">Tambahan Topping</span>

                        <div class="options">
                            <?php foreach ($menuTopping as $namaMenu => $harga): ?>
                                <label class="option">
                                    <input type="checkbox" name="topping[]"
                                        value="<?= htmlspecialchars($namaMenu, ENT_QUOTES, "UTF-8") ?>"
                                    <?= in_array($namaMenu, $toppingDipilih, true) ? "checked" : "" ?>
                                    >
                                    <?= htmlspecialchars($namaMenu) ?>
                                    (+
                                    <?= rupiah($harga) ?>)
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_pesanan">Jenis Pesanan</label>
                        <select id="jenis_pesanan" name="jenis_pesanan" required>
                            <?php foreach (
                                ["Makan di tempat", "Dibungkus", "Antar ke rumah"]
                                as $pilihan
                            ): ?>
                                <option value="<?= htmlspecialchars($pilihan) ?>" <?= $jenisPesanan === $pilihan ? "selected" : "" ?>
                                    >
                                    <?= htmlspecialchars($pilihan) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pembayaran">Metode Pembayaran</label>
                        <select id="pembayaran" name="pembayaran" required>
                            <?php foreach (
                                ["Tunai", "QRIS", "Transfer bank"]
                                as $pilihan
                            ): ?>
                                <option value="<?= htmlspecialchars($pilihan) ?>" <?= $pembayaran === $pilihan ? "selected" : "" ?>
                                    >
                                    <?= htmlspecialchars($pilihan) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <button type="submit" class="submit-btn">
                            Pesan Sekarang 🍽️
                        </button>
                    </div>

                </div>
            </form>
        </section>

        <?php if ($pesananDikirim && empty($errors)): ?>

            <section class="card">
                <h2>🧾 Ringkasan Pesanan</h2>

                <div class="success">
                    <strong>Pesanan berhasil dihitung!</strong><br>
                    Terima kasih,
                    <?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?>.
                    Berikut rincian pesananmu.
                </div>

                <table class="summary-table">
                    <tr>
                        <td>Nama Pemesan</td>
                        <td>
                            <?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8") ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Makanan</td>
                        <td>
                            <?= htmlspecialchars($makanan) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Jumlah Porsi</td>
                        <td>
                            <?= $jumlah ?> porsi
                        </td>
                    </tr>

                    <tr>
                        <td>Minuman</td>
                        <td>
                            <?= htmlspecialchars($minuman) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Topping</td>
                        <td>
                            <?php if (empty($toppingDipilih)): ?>
                                Tanpa topping
                            <?php else: ?>
                                <?php foreach ($toppingDipilih as $topping): ?>
                                    <?= htmlspecialchars($topping) ?><br>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Tingkat Kepedasan</td>
                        <td>
                            <?= htmlspecialchars($pedas) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Jenis Pesanan</td>
                        <td>
                            <?= htmlspecialchars($jenisPesanan) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Pembayaran</td>
                        <td>
                            <?= htmlspecialchars($pembayaran) ?>
                        </td>
                    </tr>
                </table>

                <div class="total-box">
                    <div class="total-row">
                        <span>Subtotal pesanan</span>
                        <strong>
                            <?= rupiah($total) ?>
                        </strong>
                    </div>

                    <div class="total-row">
                        <span>Diskon</span>
                        <strong>-
                            <?= rupiah($diskon) ?>
                        </strong>
                    </div>

                    <div class="total-row grand-total">
                        <span>Total Bayar</span>
                        <span>
                            <?= rupiah($totalBayar) ?>
                        </span>
                    </div>

                    <p style="margin-top: 15px; font-size: 13px; line-height: 1.6;">
                        <?php if ($diskon > 0): ?>
                            Selamat! Kamu mendapatkan diskon
                            <?= $total >= 100000 ? "15%" : ($total >= 50000 ? "10%" : "5%") ?>.
                        <?php else: ?>
                            Belanja minimal Rp30.000 untuk mendapatkan diskon.
                        <?php endif; ?>
                    </p>
                </div>
            </section>

        <?php endif; ?>

        <footer class="footer">
            <p>Food Order &copy;
                <?= date("Y") ?> | PHP Praktikum
            </p>
        </footer>

    </div>

</body>

</html>