<?php
session_start();

// ======================================
// CAMPUSMART - TOKO ONLINE KAMPUS
// ======================================

// Variabel
$pesan = "";
$jenis_pesan = "";
$hasil_checkout = false;
$nama_pembeli = "";
$metode_bayar = "";
$pengambilan = "";
$status_mahasiswa = "ya";
$kode_diskon = "";
$kategori_pilihan = "Semua";
$cari = "";

// Array produk
$produk = array(
    1 => array("nama" => "Buku Tulis", "kategori" => "Alat Tulis", "harga" => 5000, "stok" => 30),
    2 => array("nama" => "Pulpen", "kategori" => "Alat Tulis", "harga" => 3000, "stok" => 50),
    3 => array("nama" => "Flashdisk", "kategori" => "Elektronik", "harga" => 45000, "stok" => 12),
    4 => array("nama" => "Tumbler", "kategori" => "Aksesori", "harga" => 25000, "stok" => 15),
    5 => array("nama" => "Totebag", "kategori" => "Aksesori", "harga" => 4000, "stok" => 20),
    6 => array("nama" => "Kalkulator", "kategori" => "Elektronik", "harga" => 30000, "stok" => 8),
    7 => array("nama" => "Map Kuliah", "kategori" => "Alat Tulis", "harga" => 5000, "stok" => 40),
    8 => array("nama" => "Mouse Wireless", "kategori" => "Elektronik", "harga" => 65000, "stok" => 10),
    9 => array("nama" => "Headset", "kategori" => "Elektronik", "harga" => 75000, "stok" => 5),
    10 => array("nama" => "Binder", "kategori" => "Alat Tulis", "harga" => 25000, "stok" => 25),
    11 => array("nama" => "Stabilo", "kategori" => "Alat Tulis", "harga" => 10000, "stok" => 30),
    12 => array("nama" => "Sticky Notes", "kategori" => "Alat Tulis", "harga" => 7000, "stok" => 40),
    13 => array("nama" => "Powerbank", "kategori" => "Elektronik", "harga" => 150000, "stok" => 10),
    14 => array("nama" => "Lanyard ID Card", "kategori" => "Aksesori", "harga" => 15000, "stok" => 35),
    15 => array("nama" => "Payung Lipat", "kategori" => "Aksesori", "harga" => 35000, "stok" => 15)
);


// Keranjang disimpan sementara dalam session
if (!isset($_SESSION["keranjang"])) {
    $_SESSION["keranjang"] = array();
}

function rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ",", ".");
}

function aman($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, "UTF-8");
}

function hitung_diskon($subtotal, $kode_diskon, $status_mahasiswa)
{
    $diskon = 0;
    $pesan_diskon = "";

    if (strtoupper(trim($kode_diskon)) == "CAMPUS10" && $subtotal >= 50000) {
        $diskon = $subtotal * 0.10;
        $pesan_diskon = "Kode CAMPUS10 aktif (10%).";
    } elseif (strtoupper(trim($kode_diskon)) == "HEMAT5" && $subtotal >= 25000) {
        $diskon = $subtotal * 0.05;
        $pesan_diskon = "Kode HEMAT5 aktif (5%).";
    } elseif (trim($kode_diskon) != "") {
        $pesan_diskon = "Kode diskon tidak valid atau belum memenuhi minimum belanja.";
    }

    // Diskon mahasiswa hanya digunakan jika kode diskon tidak digunakan
    if ($diskon == 0 && $status_mahasiswa == "ya" && $subtotal >= 100000) {
        $diskon = $subtotal * 0.05;
        $pesan_diskon = "Diskon mahasiswa 5% berhasil diterapkan.";
    }

    return array($diskon, $pesan_diskon);
}

function hitung_subtotal($keranjang, $produk)
{
    $subtotal = 0;
    foreach ($keranjang as $id => $jumlah) {
        if (isset($produk[$id])) {
            $subtotal += $produk[$id]["harga"] * $jumlah;
        }
    }
    return $subtotal;
}

// Proses semua formulir menggunakan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aksi = $_POST["aksi"] ?? "";

    if ($aksi == "tambah") {
        $id = filter_var($_POST["id_produk"] ?? "", FILTER_VALIDATE_INT);
        $jumlah = filter_var($_POST["jumlah"] ?? "", FILTER_VALIDATE_INT);

        if ($id === false || !isset($produk[$id])) {
            $pesan = "Produk tidak ditemukan.";
            $jenis_pesan = "error";
        } elseif ($jumlah === false || $jumlah < 1 || $jumlah > 20) {
            $pesan = "Jumlah harus antara 1 sampai 20.";
            $jenis_pesan = "error";
        } else {
            $jumlah_lama = $_SESSION["keranjang"][$id] ?? 0;
            if ($jumlah_lama + $jumlah > $produk[$id]["stok"]) {
                $pesan = "Jumlah melebihi stok yang tersedia.";
                $jenis_pesan = "error";
            } else {
                $_SESSION["keranjang"][$id] = $jumlah_lama + $jumlah;
                $pesan = $produk[$id]["nama"] . " berhasil ditambahkan ke keranjang.";
                $jenis_pesan = "success";
            }
        }
    } elseif ($aksi == "ubah_jumlah") {
        $id = filter_var($_POST["id_produk"] ?? "", FILTER_VALIDATE_INT);
        $perubahan = filter_var($_POST["perubahan"] ?? "", FILTER_VALIDATE_INT);

        if ($id !== false && isset($_SESSION["keranjang"][$id]) && ($perubahan === 1 || $perubahan === -1)) {
            $jumlah_baru = $_SESSION["keranjang"][$id] + $perubahan;
            if ($jumlah_baru <= 0) {
                unset($_SESSION["keranjang"][$id]);
            } elseif ($jumlah_baru <= $produk[$id]["stok"]) {
                $_SESSION["keranjang"][$id] = $jumlah_baru;
            }
        }
    } elseif ($aksi == "hapus") {
        $id = filter_var($_POST["id_produk"] ?? "", FILTER_VALIDATE_INT);
        if ($id !== false && isset($_SESSION["keranjang"][$id])) {
            unset($_SESSION["keranjang"][$id]);
            $pesan = "Produk dihapus dari keranjang.";
            $jenis_pesan = "success";
        }
    } elseif ($aksi == "kosongkan") {
        $_SESSION["keranjang"] = array();
        $pesan = "Keranjang berhasil dikosongkan.";
        $jenis_pesan = "success";
    } elseif ($aksi == "checkout") {
        $nama_pembeli = trim($_POST["nama_pembeli"] ?? "");
        $metode_bayar = $_POST["metode_bayar"] ?? "";
        $pengambilan = $_POST["pengambilan"] ?? "";
        $status_mahasiswa = $_POST["status_mahasiswa"] ?? "tidak";
        $kode_diskon = trim($_POST["kode_diskon"] ?? "");

        if ($nama_pembeli == "" || strlen($nama_pembeli) > 60) {
            $pesan = "Nama wajib diisi (maksimal 60 karakter).";
            $jenis_pesan = "error";
        } elseif (empty($_SESSION["keranjang"])) {
            $pesan = "Keranjang masih kosong. Tambahkan produk terlebih dahulu.";
            $jenis_pesan = "error";
        } elseif (!in_array($metode_bayar, array("Tunai", "Transfer", "QRIS"))) {
            $pesan = "Silakan pilih metode pembayaran yang tersedia.";
            $jenis_pesan = "error";
        } elseif (!in_array($pengambilan, array("Ambil di toko", "Antar ke kos"))) {
            $pesan = "Silakan pilih cara pengambilan barang.";
            $jenis_pesan = "error";
        } elseif (!in_array($status_mahasiswa, array("ya", "tidak"))) {
            $pesan = "Pilihan status mahasiswa tidak valid.";
            $jenis_pesan = "error";
        } else {
            $subtotal_checkout = hitung_subtotal($_SESSION["keranjang"], $produk);
            list($diskon_checkout, $pesan_diskon_checkout) = hitung_diskon(
                $subtotal_checkout,
                $kode_diskon,
                $status_mahasiswa
            );

            if ($pengambilan == "Antar ke kos") {
                $ongkir_checkout = 10000;
            } else {
                $ongkir_checkout = 0;
            }

            $total_checkout = $subtotal_checkout - $diskon_checkout + $ongkir_checkout;

            // Salin data transaksi untuk ditampilkan
            $hasil_checkout = array(
                "nama" => $nama_pembeli,
                "metode" => $metode_bayar,
                "pengambilan" => $pengambilan,
                "mahasiswa" => $status_mahasiswa,
                "keranjang" => $_SESSION["keranjang"],
                "subtotal" => $subtotal_checkout,
                "diskon" => $diskon_checkout,
                "pesan_diskon" => $pesan_diskon_checkout,
                "ongkir" => $ongkir_checkout,
                "total" => $total_checkout
            );
            $_SESSION["transaksi_terakhir"] = $hasil_checkout;
            $_SESSION["keranjang"] = array();
            $pesan = "Checkout berhasil! Ringkasan transaksi ditampilkan di bawah.";
            $jenis_pesan = "success";
        }
    }
}

// Tampilkan hasil checkout terakhir setelah keranjang dikosongkan
if (isset($_SESSION["transaksi_terakhir"])) {
    $hasil_checkout = $_SESSION["transaksi_terakhir"];
}

// Filter katalog
$kategori_pilihan = $_GET["kategori"] ?? "Semua";
$cari = trim($_GET["cari"] ?? "");
$kategori_valid = array("Semua", "Alat Tulis", "Elektronik", "Aksesori");
if (!in_array($kategori_pilihan, $kategori_valid)) {
    $kategori_pilihan = "Semua";
}

$jumlah_keranjang = array_sum($_SESSION["keranjang"]);
$subtotal_keranjang = hitung_subtotal($_SESSION["keranjang"], $produk);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMart - Belanja Kebutuhan Kampus</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        header {
            background: #10192e;
            color: white;
        }

        .nav {
            max-width: 1250px;
            margin: auto;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: #5145ed;
            border-radius: 10px;
            padding: 12px;
            font-size: 22px;
        }

        .logo h1 {
            font-size: 20px;
            margin: 0 0 4px;
        }

        .logo p {
            margin: 0;
            color: #aab4c8;
            font-size: 13px;
        }

        .cart-count {
            background: #202b42;
            border-radius: 12px;
            padding: 13px 17px;
            font-weight: bold;
            white-space: nowrap;
        }

        .container {
            max-width: 1250px;
            margin: 28px auto;
            padding: 0 20px;
        }

        .notice {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .success {
            background: #d1fae5;
            color: #047857;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(310px, 1fr);
            gap: 28px;
            align-items: start;
        }

        .catalog-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .catalog-head h2 {
            margin: 0 0 5px;
            font-size: 25px;
        }

        .muted {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        input,
        select {
            font: inherit;
        }

        .search-form input {
            width: 210px;
        }

        input[type="text"],
        input[type="number"],
        select {
            border: 1px solid #dce2ec;
            background: white;
            padding: 11px 12px;
            border-radius: 10px;
            min-width: 0;
        }

        .btn {
            display: inline-block;
            border: 0;
            background: #5145ed;
            color: white;
            padding: 11px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }

        .btn:hover {
            background: #4035ce;
        }

        .btn-dark {
            background: #1e293b;
        }

        .btn-dark:hover {
            background: #0f172a;
        }

        .btn-light {
            background: white;
            color: #334155;
            border: 1px solid #dce2ec;
        }

        .btn-danger {
            background: white;
            color: #e11d48;
            border: 0;
            padding: 5px;
            cursor: pointer;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .product {
            background: white;
            border: 1px solid #e1e6ef;
            border-radius: 17px;
            padding: 20px;
        }

        .product-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .tag {
            background: #eef2ff;
            color: #5145ed;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .stock {
            color: #64748b;
            font-size: 12px;
        }

        .product h3 {
            font-size: 16px;
            margin: 0 0 12px;
        }

        .price {
            color: #5145ed;
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .add-form {
            display: flex;
            gap: 8px;
        }

        .add-form input {
            width: 82px;
        }

        .add-form button {
            flex: 1;
        }

        .panel {
            background: white;
            border: 1px solid #e1e6ef;
            border-radius: 17px;
            padding: 20px;
            position: sticky;
            top: 15px;
        }

        .panel h2 {
            font-size: 19px;
            margin: 3px 0 18px;
        }

        .cart-item {
            border-top: 1px solid #e5e7eb;
            padding: 15px 0;
        }

        .cart-item strong {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .cart-sub {
            color: #64748b;
            font-size: 13px;
        }

        .cart-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .inline-form {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .inline-form button {
            padding: 4px 9px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            font-size: 14px;
        }

        .summary-line.total {
            border-top: 1px dashed #d8dee9;
            margin-top: 5px;
            padding-top: 15px;
            font-size: 17px;
            font-weight: bold;
        }

        .green {
            color: #059669;
        }

        .small-label {
            font-size: 12px;
            color: #64748b;
            font-weight: bold;
            margin: 17px 0 8px;
        }

        .checkout input[type="text"],
        .checkout select {
            width: 100%;
            margin-bottom: 9px;
        }

        .checkout label {
            display: block;
            font-size: 13px;
            margin: 10px 0 6px;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 20px 0;
        }

        .receipt {
            margin-top: 24px;
        }

        .receipt h2 {
            margin-bottom: 8px;
        }

        footer {
            text-align: center;
            padding: 22px;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .panel {
                position: static;
            }
        }

        @media (max-width: 580px) {
            .nav {
                padding: 14px;
            }

            .logo h1 {
                font-size: 17px;
            }

            .cart-count {
                font-size: 12px;
                padding: 10px;
            }

            .container {
                padding: 0 12px;
                margin-top: 18px;
            }

            .products {
                grid-template-columns: 1fr;
            }

            .product {
                padding: 16px;
            }

            .search-form {
                width: 100%;
            }

            .search-form input {
                width: 100%;
                flex: 1;
            }

            .catalog-head {
                align-items: stretch;
            }

            .catalog-head h2 {
                font-size: 22px;
            }
        }

        @media print {

            header,
            .layout,
            .notice,
            footer,
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }

            .container {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 0;
            }

            .receipt {
                display: block !important;
                border: 0;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="nav">
            <div class="logo">
                <div class="logo-icon">▣</div>
                <div>
                    <h1>CampusMart</h1>
                    <p>Belanja Kebutuhan Kampus</p>
                </div>
            </div>
            <div class="cart-count">🛒 Keranjang (<?php echo (int) $jumlah_keranjang; ?>)</div>
        </div>
    </header>

    <div class="container">

        <?php if ($pesan != "") { ?>
            <div class="notice <?php echo $jenis_pesan == "error" ? "error" : "success"; ?>">
                <?php echo aman($pesan); ?>
            </div>
        <?php } ?>

        <div class="layout">
            <main>
                <div class="catalog-head">
                    <div>
                        <h2>Katalog Produk</h2>
                        <p class="muted">Pilih produk untuk ditambahkan ke keranjang.</p>
                    </div>
                    <form method="GET" class="search-form">
                        <input type="text" name="cari" placeholder="Cari produk..." value="<?php echo aman($cari); ?>">
                        <button class="btn" type="submit">Cari</button>
                    </form>
                </div>

                <form method="GET" class="no-print"
                    style="margin-bottom:16px; display:flex; gap:8px; align-items:center;">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" id="kategori" onchange="this.form.submit()">
                        <?php foreach ($kategori_valid as $kat) { ?>
                            <option value="<?php echo aman($kat); ?>" <?php echo $kategori_pilihan == $kat ? "selected" : ""; ?>>
                                <?php echo aman($kat); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="cari" value="<?php echo aman($cari); ?>">
                </form>

                <div class="products">
                    <?php
                    $ada_produk = false;
                    foreach ($produk as $id => $barang) {
                        $cocok_kategori = ($kategori_pilihan == "Semua" || $barang["kategori"] == $kategori_pilihan);
                        $cocok_cari = ($cari == "" || stripos($barang["nama"], $cari) !== false);

                        if ($cocok_kategori && $cocok_cari) {
                            $ada_produk = true;
                            ?>
                            <div class="product">
                                <div class="product-top">
                                    <span class="tag"><?php echo aman($barang["kategori"]); ?></span>
                                    <span class="stock">Stok: <?php echo (int) $barang["stok"]; ?></span>
                                </div>
                                <h3><?php echo aman($barang["nama"]); ?></h3>
                                <div class="price"><?php echo rupiah($barang["harga"]); ?></div>

                                <form method="POST" class="add-form">
                                    <input type="hidden" name="aksi" value="tambah">
                                    <input type="hidden" name="id_produk" value="<?php echo (int) $id; ?>">
                                    <input type="number" name="jumlah" min="1" max="20" value="1" aria-label="Jumlah produk">
                                    <button class="btn" type="submit">＋ Tambah</button>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    if (!$ada_produk) {
                        echo '<div class="product">Produk tidak ditemukan.</div>';
                    }
                    ?>
                </div>
            </main>

            <aside class="panel">
                <h2>Keranjang Belanja</h2>

                <?php if (empty($_SESSION["keranjang"])) { ?>
                    <div class="empty">Keranjang masih kosong.<br>Pilih produk untuk mulai belanja.</div>
                <?php } else { ?>

                    <?php foreach ($_SESSION["keranjang"] as $id => $jumlah) { ?>
                        <?php if (isset($produk[$id])) { ?>
                            <div class="cart-item">
                                <strong><?php echo aman($produk[$id]["nama"]); ?></strong>
                                <div class="cart-sub">
                                    <?php echo rupiah($produk[$id]["harga"]); ?> × <?php echo (int) $jumlah; ?>
                                </div>
                                <div class="cart-controls">
                                    <form method="POST" class="inline-form">
                                        <input type="hidden" name="aksi" value="ubah_jumlah">
                                        <input type="hidden" name="id_produk" value="<?php echo (int) $id; ?>">
                                        <button type="submit" name="perubahan" value="-1">−</button>
                                        <span><?php echo (int) $jumlah; ?></span>
                                        <button type="submit" name="perubahan" value="1">+</button>
                                    </form>

                                    <form method="POST">
                                        <input type="hidden" name="aksi" value="hapus">
                                        <input type="hidden" name="id_produk" value="<?php echo (int) $id; ?>">
                                        <button type="submit" class="btn-danger">🗑 Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="summary-line">
                        <span>Subtotal</span>
                        <span><?php echo rupiah($subtotal_keranjang); ?></span>
                    </div>

                    <form method="POST" class="checkout">
                        <input type="hidden" name="aksi" value="checkout">

                        <div class="small-label">DATA PEMBELI</div>
                        <label>Nama Pembeli</label>
                        <input type="text" name="nama_pembeli" maxlength="60" placeholder="Masukkan nama Anda" required>

                        <label>Status Pembeli</label>
                        <select name="status_mahasiswa">
                            <option value="ya">Mahasiswa</option>
                            <option value="tidak">Umum</option>
                        </select>

                        <label>Kode Diskon</label>
                        <input type="text" name="kode_diskon" placeholder="CAMPUS10 / HEMAT5">

                        <label>Metode Pembayaran</label>
                        <select name="metode_bayar" required>
                            <option value="">Pilih pembayaran</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <label>Pengambilan Barang</label>
                        <select name="pengambilan" required>
                            <option value="">Pilih pengambilan</option>
                            <option value="Ambil di toko">Ambil di toko (gratis)</option>
                            <option value="Antar ke kos">Antar ke kos (+Rp 10.000)</option>
                        </select>

                        <button class="btn" type="submit" style="width:100%; margin-top:8px;">Proses Checkout</button>
                    </form>

                    <form method="POST" class="no-print" style="margin-top:10px;">
                        <input type="hidden" name="aksi" value="kosongkan">
                        <button type="submit" class="btn btn-light" style="width:100%;">Kosongkan Keranjang</button>
                    </form>
                <?php } ?>
            </aside>
        </div>

        <?php if (is_array($hasil_checkout)) { ?>
            <section class="card receipt"
                style="background:white; border:1px solid #e1e6ef; border-radius:17px; padding:22px;">
                <h2>Ringkasan Transaksi</h2>
                <p>Terima kasih, <strong><?php echo aman($hasil_checkout["nama"]); ?></strong>!</p>
                <p>Metode pembayaran: <?php echo aman($hasil_checkout["metode"]); ?></p>
                <p>Pengambilan: <?php echo aman($hasil_checkout["pengambilan"]); ?></p>

                <table style="width:100%; border-collapse:collapse;">
                    <tr style="text-align:left; background:#eef2ff;">
                        <th style="padding:10px;">Produk</th>
                        <th style="padding:10px;">Jumlah</th>
                        <th style="padding:10px;">Subtotal</th>
                    </tr>
                    <?php foreach ($hasil_checkout["keranjang"] as $id => $jumlah) { ?>
                        <?php if (isset($produk[$id])) { ?>
                            <tr>
                                <td style="padding:10px; border-bottom:1px solid #e5e7eb;"><?php echo aman($produk[$id]["nama"]); ?>
                                </td>
                                <td style="padding:10px; border-bottom:1px solid #e5e7eb;"><?php echo (int) $jumlah; ?></td>
                                <td style="padding:10px; border-bottom:1px solid #e5e7eb;">
                                    <?php echo rupiah($produk[$id]["harga"] * $jumlah); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>

                <div class="summary-line">
                    <span>Subtotal</span><span><?php echo rupiah($hasil_checkout["subtotal"]); ?></span></div>
                <div class="summary-line"><span>Diskon</span><span class="green">-
                        <?php echo rupiah($hasil_checkout["diskon"]); ?></span></div>
                <?php if ($hasil_checkout["pesan_diskon"] != "") { ?>
                    <p class="muted"><?php echo aman($hasil_checkout["pesan_diskon"]); ?></p>
                <?php } ?>
                <div class="summary-line"><span>Biaya
                        pengantaran</span><span><?php echo rupiah($hasil_checkout["ongkir"]); ?></span></div>
                <div class="summary-line total"><span>Total
                        Bayar</span><span><?php echo rupiah($hasil_checkout["total"]); ?></span></div>

                <?php
                if ($hasil_checkout["total"] >= 200000) {
                    $status_transaksi = "Belanja besar";
                } elseif ($hasil_checkout["total"] >= 75000) {
                    $status_transaksi = "Belanja sedang";
                } else {
                    $status_transaksi = "Belanja hemat";
                }
                ?>
                <p><strong>Status transaksi:</strong> <?php echo aman($status_transaksi); ?></p>
                <button class="btn no-print" onclick="window.print()">Cetak Ringkasan</button>
            </section>
        <?php } ?>

    </div>

    <footer>CampusMart &copy; 2026 | Proyek Praktikum PHP Pemula</footer>
</body>

</html>
'''
out = Path("/mnt/data/index.php")
out.write_text(code, encoding="utf-8")
print(f"File berhasil dibuat: {out}")