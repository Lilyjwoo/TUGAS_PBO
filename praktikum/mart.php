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
    $alamat_pembeli = "";
    $status_pembayaran = "";

    // Array produk
    $produk = array(
        1 => array("nama" => "Buku Tulis", "kategori" => "Alat Tulis", "harga" => 5000, "stok" => 30),
        2 => array("nama" => "Pulpen", "kategori" => "Alat Tulis", "harga" => 3000, "stok" => 50),
        3 => array("nama" => "Flashdisk", "kategori" => "Elektronik", "harga" => 45000, "stok" => 12),
        4 => array("nama" => "Tumbler", "kategori" => "Aksesori", "harga" => 25000, "stok" => 15),
        5 => array("nama" => "Totebag", "kategori" => "Aksesori", "harga" => 5000, "stok" => 20),
        6 => array("nama" => "Kalkulator", "kategori" => "Elektronik", "harga" => 35000, "stok" => 8),
        7 => array("nama" => "Map Kuliah", "kategori" => "Alat Tulis", "harga" => 5000, "stok" => 40),
        8 => array("nama" => "Mouse Wireless", "kategori" => "Elektronik", "harga" => 65000, "stok" => 10),
        9 => array("nama" => "Headset", "kategori" => "Elektronik", "harga" => 120000, "stok" => 5),
        10 => array("nama" => "Binder", "kategori" => "Alat Tulis", "harga" => 25000, "stok" => 25),
        11 => array("nama" => "Stabilo", "kategori" => "Alat Tulis", "harga" => 10000, "stok" => 30),
        12 => array("nama" => "Sticky Notes", "kategori" => "Alat Tulis", "harga" => 7000, "stok" => 40),
        13 => array("nama" => "Powerbank", "kategori" => "Elektronik", "harga" => 150000, "stok" => 10),
        14 => array("nama" => "Lanyard ID Card", "kategori" => "Aksesori", "harga" => 15000, "stok" => 35),
        15 => array("nama" => "Payung Lipat", "kategori" => "Aksesori", "harga" => 35000, "stok" => 15),
        16 => array("nama" => "Pensil Mekanik", "kategori" => "Alat Tulis", "harga" => 12000, "stok" => 25),
        17 => array("nama" => "Penghapus Karet", "kategori" => "Alat Tulis", "harga" => 3000, "stok" => 50),
        18 => array("nama" => "Correction Tape", "kategori" => "Alat Tulis", "harga" => 9000, "stok" => 30),
        19 => array("nama" => "Gunting Kecil", "kategori" => "Alat Tulis", "harga" => 6000, "stok" => 20),
        20 => array("nama" => "Lem Kertas", "kategori" => "Alat Tulis", "harga" => 5000, "stok" => 25),
        21 => array("nama" => "Jangka Besi", "kategori" => "Alat Tulis", "harga" => 15000, "stok" => 15),
        22 => array("nama" => "Penggaris 30cm", "kategori" => "Alat Tulis", "harga" => 4000, "stok" => 45),
        23 => array("nama" => "Buku Gambar A4", "kategori" => "Alat Tulis", "harga" => 12000, "stok" => 20),
        24 => array("nama" => "Kertas HVS A4 (Rim)", "kategori" => "Alat Tulis", "harga" => 45000, "stok" => 15),
        25 => array("nama" => "Buku Kotak-kotak", "kategori" => "Alat Tulis", "harga" => 7000, "stok" => 20),
        26 => array("nama" => "Kabel Data Type-C", "kategori" => "Elektronik", "harga" => 25000, "stok" => 30),
        27 => array("nama" => "Kabel Charger Micro", "kategori" => "Elektronik", "harga" => 20000, "stok" => 25),
        28 => array("nama" => "Adaptor Charger USB", "kategori" => "Elektronik", "harga" => 45000, "stok" => 18),
        29 => array("nama" => "Card Reader", "kategori" => "Elektronik", "harga" => 15000, "stok" => 20),
        30 => array("nama" => "Baterai Kotak 9V", "kategori" => "Elektronik", "harga" => 18000, "stok" => 15),
        31 => array("nama" => "Baterai AA (isi 2)", "kategori" => "Elektronik", "harga" => 10000, "stok" => 40),
        32 => array("nama" => "Kalkulator Scientific", "kategori" => "Elektronik", "harga" => 110000, "stok" => 7),
        33 => array("nama" => "Lampu Belajar LED", "kategori" => "Elektronik", "harga" => 65000, "stok" => 10),
        34 => array("nama" => "Kipas Angin Mini USB", "kategori" => "Elektronik", "harga" => 35000, "stok" => 12),
        35 => array("nama" => "Keyboard Mini USB", "kategori" => "Elektronik", "harga" => 95000, "stok" => 6),
        36 => array("nama" => "Jas Lab Praktikum", "kategori" => "Aksesori", "harga" => 95000, "stok" => 15),
        37 => array("nama" => "Topi Almamater", "kategori" => "Aksesori", "harga" => 25000, "stok" => 20),
        38 => array("nama" => "Gantungan Kunci Kampus", "kategori" => "Aksesori", "harga" => 8000, "stok" => 50),
        39 => array("nama" => "Pouch Tas Kosmetik", "kategori" => "Aksesori", "harga" => 18000, "stok" => 25),
        40 => array("nama" => "Dompet STNK / Kartu", "kategori" => "Aksesori", "harga" => 22000, "stok" => 20),
        41 => array("nama" => "Masker Kain (isi 3)", "kategori" => "Aksesori", "harga" => 15000, "stok" => 40),
        42 => array("nama" => "Hand Sanitizer Saku", "kategori" => "Aksesori", "harga" => 10000, "stok" => 45),
        43 => array("nama" => "Tempat Pensil Kain", "kategori" => "Aksesori", "harga" => 15000, "stok" => 30),
        44 => array("nama" => "Sajadah Travel Lipat", "kategori" => "Aksesori", "harga" => 30000, "stok" => 15),
        45 => array("nama" => "Botol Spray Alkohol", "kategori" => "Aksesori", "harga" => 6000, "stok" => 35),
        46 => array("nama" => "Buku Catatan Saku", "kategori" => "Alat Tulis", "harga" => 4000, "stok" => 50),
        47 => array("nama" => "Kertas Origami (Pak)", "kategori" => "Alat Tulis", "harga" => 8000, "stok" => 25),
        48 => array("nama" => "Keychain", "kategori" => "Aksesori", "harga" => 12000, "stok" => 10),
        49 => array("nama" => "Mousepad Gaming", "kategori" => "Elektronik", "harga" => 35000, "stok" => 14),
        50 => array("nama" => "Sling Bag Mini", "kategori" => "Aksesori", "harga" => 45000, "stok" => 12)
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
            if (
                $id !== false &&
                isset($_SESSION["keranjang"][$id]) &&
                ($perubahan === 1 || $perubahan === -1)
            ) {
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
            $alamat = trim($_POST["alamat_pembeli"] ?? "");
            if ($nama_pembeli == "" || strlen($nama_pembeli) > 60) {
                $pesan = "Nama wajib diisi (maksimal 60 karakter).";
                $jenis_pesan = "error";
            } elseif (empty($_SESSION["keranjang"])) {
                $pesan = "Keranjang masih kosong.";
                $jenis_pesan = "error";
            } elseif (!in_array($metode_bayar, array("Tunai", "Transfer", "QRIS"))) {
                $pesan = "Silakan pilih metode pembayaran.";
                $jenis_pesan = "error";
            } elseif (!in_array($pengambilan, array("Ambil di toko", "Antar ke kos"))) {
                $pesan = "Silakan pilih metode pengambilan barang.";
                $jenis_pesan = "error";
            } elseif ($pengambilan == "Antar ke kos" && $alamat == "") {
                $pesan = "Alamat pengantaran wajib diisi.";
                $jenis_pesan = "error";
            } elseif (!in_array($status_mahasiswa, array("ya", "tidak"))) {
                $pesan = "Status pembeli tidak valid.";
                $jenis_pesan = "error";
            } else {
                $subtotal_checkout = hitung_subtotal(
                    $_SESSION["keranjang"],
                    $produk
                );
                list($diskon_checkout, $pesan_diskon_checkout) = hitung_diskon(
                    $subtotal_checkout,
                    $kode_diskon,
                    $status_mahasiswa
                );
                $ongkir_checkout = ($pengambilan == "Antar ke kos")
                    ? 10000
                    : 0;
                $total_checkout = $subtotal_checkout
                    - $diskon_checkout
                    + $ongkir_checkout;
                $_SESSION["checkout_pending"] = array(
                    "nama" => $nama_pembeli,
                    "metode" => $metode_bayar,
                    "pengambilan" => $pengambilan,
                    "alamat" => $alamat,
                    "mahasiswa" => $status_mahasiswa,
                    "kode_diskon" => $kode_diskon,
                    "keranjang" => $_SESSION["keranjang"],
                    "subtotal" => $subtotal_checkout,
                    "diskon" => $diskon_checkout,
                    "pesan_diskon" => $pesan_diskon_checkout,
                    "ongkir" => $ongkir_checkout,
                    "total" => $total_checkout
                );
                $pesan = "Checkout berhasil. Silakan periksa ringkasan dan pembayaran.";
                $jenis_pesan = "success";
            }
        } elseif ($aksi == "selesaikan_transaksi") {
            if (!isset($_SESSION["checkout_pending"])) {
                $pesan = "Data checkout tidak ditemukan.";
                $jenis_pesan = "error";
            } else {
                $transaksi = $_SESSION["checkout_pending"];
                $transaksi["status_pembayaran"] = "Selesai";
                $_SESSION["transaksi_terakhir"] = $transaksi;
                $_SESSION["keranjang"] = array();
                unset($_SESSION["checkout_pending"]);
                $pesan = "Transaksi berhasil diselesaikan.";
                $jenis_pesan = "success";
            }
        }
    }

    // Tampilkan checkout yang sedang menunggu pembayaran
    if (isset($_SESSION["checkout_pending"])) {
        $hasil_checkout = $_SESSION["checkout_pending"];
    } elseif (isset($_SESSION["transaksi_terakhir"])) {
        $hasil_checkout = $_SESSION["transaksi_terakhir"];
    }

    // Tampilkan hasil checkout terakhir
    // Menampilkan ringkasan checkout yang masih menunggu pembayaran
    if (isset($_SESSION["checkout_pending"])) {
        $hasil_checkout = $_SESSION["checkout_pending"];
    } elseif (isset($_SESSION["transaksi_terakhir"])) {
        // Menampilkan transaksi terakhir jika sudah selesai
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
            /* Informasi pembayaran */
            .info-pembayaran {
                display: none;
                margin: 12px 0;
                padding: 16px;
                border: 1px solid #dce2ec;
                border-radius: 12px;
                background: #f8faff;
                animation: paymentFade 0.3s ease;
            }
            .info-pembayaran h3 {
                margin: 0 0 12px;
                font-size: 16px;
                color: #5145ed;
            }
            .info-pembayaran p {
                margin: 8px 0;
                font-size: 14px;
                line-height: 1.6;
                overflow-wrap: anywhere;
            }
            .nomor-rekening {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
                padding: 12px;
                margin: 10px 0;
                background: white;
                border: 1px dashed #a5b4fc;
                border-radius: 8px;
            }
            .nomor-rekening strong {
                font-size: 16px;
                letter-spacing: 1px;
            }
            .btn-salin {
                padding: 7px 10px;
                border: 0;
                border-radius: 7px;
                background: #5145ed;
                color: white;
                cursor: pointer;
            }
            .btn-salin:hover {
                background: #4035ce;
            }
            .gambar-qris {
                display: block;
                width: 230px;
                max-width: 100%;
                height: auto;
                margin: 14px auto;
                padding: 8px;
                border: 1px solid #e1e6ef;
                border-radius: 10px;
                background: white;
            }
            .catatan-pembayaran {
                color: #64748b;
                font-size: 12px !important;
            }
            @keyframes paymentFade {
                from {
                    opacity: 0;
                    transform: translateY(6px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
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
                                <label for="metode_bayar">Metode Pembayaran</label>
                                <select name="metode_bayar" id="metode_bayar" required>
                                    <option value="">Pilih pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer Bank</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                                <label>Pengambilan Barang</label>
                                <select name="pengambilan" id="pengambilan" required>
                                    <option value="">Pilih pengambilan</option>
                                    <option value="Ambil di toko">Ambil di toko (gratis)</option>
                                    <option value="Antar ke kos">Antar ke kos (+Rp 10.000)</option>
                                </select>
                                <div id="form-alamat" style="display:none;">
                                    <label for="alamat_pembeli">Alamat Pengantaran</label>
                                    <input
                                        type="text"
                                        name="alamat_pembeli"
                                        id="alamat_pembeli"
                                        maxlength="200"
                                        placeholder="Masukkan alamat kos atau tujuan"
                                    >
                                    <p class="muted">Biaya pengantaran Rp10.000.</p>
                                </div>
                                <button class="btn" type="submit"
                                    style="width:100%; margin-top:8px;">
                                    Proses Checkout
                                </button>
                                </form>
                            <?php } ?>
                </aside>
            </div>
            <?php if (is_array($hasil_checkout)) { ?>
                    <section class="card receipt"
                        style="background:white; border:1px solid #e1e6ef; border-radius:17px; padding:22px;">
                        <h2>Nota Transaksi</h2>
                        <p>Terima kasih, <strong><?php echo aman($hasil_checkout["nama"]); ?></strong>!</p>
                        <p>Metode pembayaran: <?php echo aman($hasil_checkout["metode"]); ?></p>
                        <p>Pengambilan: <?php echo aman($hasil_checkout["pengambilan"]); ?></p>
                        <?php if (
                            $hasil_checkout["pengambilan"] == "Antar ke kos"
                            && !empty($hasil_checkout["alamat"])
                        ) { ?>
                                <p>
                                    Alamat pengantaran:
                            <?php echo aman($hasil_checkout["alamat"]); ?>
                                    </p>
                            <?php } ?>
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
        <hr>
        <h3>Informasi Pembayaran</h3>
        <p>
            Status pembayaran:
            <strong>
                <?php echo aman($hasil_checkout["status_pembayaran"] ?? "Menunggu pembayaran"); ?>
                            </strong>
                        </p>
                <?php if (($hasil_checkout["status_pembayaran"] ?? "") != "Selesai") { ?>
                            <?php if ($hasil_checkout["metode"] == "QRIS") { ?>
                                                <div class="info-pembayaran" style="display:block;">
                                                    <h3>Bayar dengan QRIS</h3>
                                                    <p>
                                                        Total yang harus dibayar:
                                                        <strong>
                                                            <?php echo rupiah($hasil_checkout["total"]); ?>
                                                        </strong>
                                                    </p>
                                                    <img src="qris.png" alt="QRIS CampusMart" class="gambar-qris">
                                                    <p class="catatan-pembayaran">
                                                        Scan QRIS menggunakan aplikasi pembayaran yang mendukung QRIS.
                                                        Pastikan nominalnya sesuai. Setelah membayar, konfirmasikan pesanan.
                                                    </p>
                                                </div>
                                        <?php } elseif ($hasil_checkout["metode"] == "Transfer") { ?>
                                                <div class="info-pembayaran" style="display:block;">
                                                    <h3>Transfer Bank</h3>
                                                    <p>Bank: <strong>SeaBank</strong></p>
                                                    <p>Atas Nama: <strong>CampusMart</strong></p>
                                                    <div class="nomor-rekening">
                                                        <strong id="nomor-rekening">90453295098</strong>
                                                        <button type="button" class="btn-salin" onclick="salinRekening()">
                                                            Salin Nomor
                                                        </button>
                                                    </div>
                                                    <p>
                                                        Total transfer:
                                                        <strong><?php echo rupiah($hasil_checkout["total"]); ?>
                                                        </strong>
                                                    </p>
                                                    <p class="catatan-pembayaran">
                                                        Transfer sesuai nominal yang tertera di atas.
                                                    </p>
                                                </div>
                            <?php } elseif ($hasil_checkout["metode"] == "Tunai") { ?>
                                                <div class="info-pembayaran" style="display:block;">
                                                    <h3>Pembayaran Tunai</h3>
                                                    <p>Silakan lakukan pembayaran secara tunai.</p>
                                                    <p>
                                                        Total pembayaran:
                                                        <strong>
                                                            <?php echo rupiah($hasil_checkout["total"]); ?>
                                                        </strong>
                                                    </p>
                                                </div>
                                    <?php } ?>
                                        <form method="POST" class="no-print" style="margin-top:15px;">
                                            <input type="hidden" name="aksi" value="selesaikan_transaksi">
                                            <button type="submit" class="btn" style="width:100%;"
                                                onclick="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan?')">
                                    <?php
                                    echo $hasil_checkout["metode"] == "Tunai"
                                        ? "Selesaikan Pesanan"
                                        : "Konfirmasi Pembayaran dan Selesaikan";
                                    ?>
                                            </button>
                                        </form>
                                <?php } else { ?>
                                        <p class="green">
                                            Pesanan telah selesai.
                                        </p>
                                <?php } ?>
                        <button class="btn no-print" onclick="window.print()">Cetak Nota</button>
                    </section>
            <?php } ?>
    <script>
        const metodeBayar = document.getElementById("metode_bayar");
        const pengambilan = document.getElementById("pengambilan");
        const formAlamat = document.getElementById("form-alamat");
        const alamatPembeli = document.getElementById("alamat_pembeli");
        function tampilkanAlamat() {
            if (pengambilan.value === "Antar ke kos") {
                formAlamat.style.display = "block";
                alamatPembeli.required = true;
            } else {
                formAlamat.style.display = "none";
                alamatPembeli.required = false;
                alamatPembeli.value = "";
            }
        }
        function salinRekening() {
            const nomor = document.getElementById("nomor-rekening").textContent;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(nomor)
                    .then(function () {
                        alert("Nomor rekening berhasil disalin!");
                    })
                    .catch(function () {
                        alert("Silakan salin nomor rekening: " + nomor);
                    });
            } else {
                alert("Silakan salin nomor rekening: " + nomor);
            }
        }
        pengambilan.addEventListener("change", tampilkanAlamat);
        
        // Jalankan saat halaman dibuka.
        tampilkanAlamat();
    </script>
        <footer>CampusMart &copy; 2026 | Proyek Praktikum PHP Pemula</footer>
        </body>
    </html>
