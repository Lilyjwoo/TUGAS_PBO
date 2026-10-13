
<?php
// ==========================================
// 1. FUNCTION UNTUK MENGHITUNG TOTAL PENGELUARAN
// ==========================================
function hitungTotal($pengeluaran)
{
    $total = 0;

    foreach ($pengeluaran as $biaya) {
        $total += $biaya;
    }

    return $total;
}

// ==========================================
// 2. NILAI AWAL
// ==========================================
$nama = "";
$uang_bulanan = 0;
$target_tabungan = 0.0;
$status_hemat = true;

$pengeluaran = [
    "Makan" => 0,
    "Transportasi" => 0,
    "Kuota Internet" => 0,
    "Kebutuhan Kuliah" => 0,
    "Hiburan" => 0
];

$total_pengeluaran = 0;
$sisa_uang = 0;
$status_keuangan = "";
$pesan = "";
$hasil = false;

// ==========================================
// 3. MEMPROSES FORM DENGAN METHOD POST
// ==========================================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST["nama"] ?? "");
    $uang_bulanan = (float) ($_POST["uang_bulanan"] ?? 0);
    $target_tabungan = (float) ($_POST["target_tabungan"] ?? 0);

    $pengeluaran["Makan"] =
        (float) ($_POST["makan"] ?? 0);

    $pengeluaran["Transportasi"] =
        (float) ($_POST["transportasi"] ?? 0);

    $pengeluaran["Kuota Internet"] =
        (float) ($_POST["kuota"] ?? 0);

    $pengeluaran["Kebutuhan Kuliah"] =
        (float) ($_POST["kuliah"] ?? 0);

    $pengeluaran["Hiburan"] =
        (float) ($_POST["hiburan"] ?? 0);

    // Validasi data
    $semua_biaya_valid = $uang_bulanan > 0
        && $target_tabungan >= 0;

    foreach ($pengeluaran as $biaya) {
        if ($biaya < 0) {
            $semua_biaya_valid = false;
        }
    }

    if ($nama !== "" && $semua_biaya_valid) {

        $hasil = true;

        // Menghitung total dan sisa uang
        $total_pengeluaran = hitungTotal($pengeluaran);
        $sisa_uang = $uang_bulanan - $total_pengeluaran;

        // Menentukan status hemat
        $status_hemat = $total_pengeluaran
            <= ($uang_bulanan * 0.7);

        // Percabangan kondisi keuangan
        if ($sisa_uang < 0) {
            $status_keuangan = "Kritis";
            $pesan = "Pengeluaran melebihi uang bulanan. Kurangi biaya yang tidak mendesak.";
        } elseif ($sisa_uang < $target_tabungan) {
            $status_keuangan = "Waspada";
            $pesan = "Sisa uang belum mencapai target tabungan. Coba evaluasi pengeluaranmu.";
        } else {
            $status_keuangan = "Aman";
            $pesan = "Keuanganmu masih terkendali. Pertahankan kebiasaan mengatur uang!";
        }

    } else {
        $pesan = "Isi nama dengan benar, uang bulanan harus lebih dari nol, dan semua biaya tidak boleh negatif.";
    }
}

// ==========================================
// 4. FORMAT RUPIAH
// ==========================================
function rupiah($angka)
{
    return "Rp" . number_format($angka, 0, ",", ".");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Survival Calculator</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f2f6fc;
            color: #24324a;
            line-height: 1.6;
        }

        .hero {
            padding: 45px 20px 65px;
            text-align: center;
            color: white;
            background: linear-gradient(135deg, #155eef, #5489ff);
        }

        .hero .icon {
            font-size: 45px;
        }

        .hero h1 {
            font-size: clamp(27px, 4vw, 40px);
            margin: 8px 0;
        }

        .hero p {
            color: #e5edff;
        }

        .container {
            max-width: 1000px;
            padding: 0 18px;
            margin: -30px auto 35px;
            position: relative;
            animation: masuk 0.7s ease;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 18px;
            margin-bottom: 22px;
            box-shadow: 0 8px 28px rgba(35, 68, 120, 0.08);
            border: 1px solid #e7edf6;
        }

        .title {
            font-size: 21px;
            color: #174caa;
            margin-bottom: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field label {
            font-size: 14px;
            font-weight: 600;
            color: #43536b;
        }

        .field input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d8e1ef;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            background: #fbfdff;
            transition: 0.2s;
        }

        .field input:focus {
            border-color: #3978f6;
            box-shadow: 0 0 0 3px #3978f620;
        }

        .full {
            grid-column: 1 / -1;
        }

        .note {
            color: #718096;
            font-size: 13px;
            margin-top: 6px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 14px;
            border: none;
            border-radius: 11px;
            color: white;
            background: linear-gradient(120deg, #2463eb, #4d83fa);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px #2463eb40;
        }

        .result-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .summary {
            padding: 20px;
            border-radius: 14px;
            background: #f1f6ff;
            border: 1px solid #e0eaff;
        }

        .summary span {
            color: #6a7b95;
            font-size: 13px;
        }

        .summary h3 {
            font-size: clamp(20px, 3vw, 26px);
            color: #1c56bc;
            margin-top: 7px;
            overflow-wrap: anywhere;
        }

        .status {
            padding: 18px;
            border-radius: 13px;
            margin-top: 20px;
        }

        .aman {
            background: #e3f8ed;
            color: #11764c;
        }

        .waspada {
            background: #fff4d8;
            color: #946200;
        }

        .kritis {
            background: #ffe7e9;
            color: #bd2638;
        }

        .status h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            padding: 13px 12px;
            border-bottom: 1px solid #e8edf5;
            text-align: left;
        }

        th {
            color: #526580;
            background: #f4f7fc;
            font-size: 13px;
        }

        td:last-child,
        th:last-child {
            text-align: right;
        }

        .money-left {
            color: #137b51;
        }

        .money-negative {
            color: #c82e42;
        }

        .message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            background: #fff3d7;
            color: #815b08;
        }

        footer {
            text-align: center;
            color: #8090a8;
            padding: 10px 15px 30px;
            font-size: 13px;
        }

        @keyframes masuk {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .form-grid,
            .result-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 19px;
            }

            th, td {
                padding: 11px 8px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<header class="hero">
    <div class="icon">💸</div>
    <h1>Student Survival Calculator</h1>
    <p>Atur uang bulanan, kendalikan pengeluaran, dan bertahan sampai akhir bulan!</p>
</header>

<main class="container">

    <section class="card">
        <h2 class="title">📝 Masukkan Data Keuangan</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !$hasil): ?>
            <div class="message">
                <?= htmlspecialchars($pesan) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <div class="form-grid">

                <div class="field full">
                    <label for="nama">Nama Mahasiswa</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama kamu"
                        value="<?= htmlspecialchars($nama) ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="uang_bulanan">Uang Bulanan (Rp)</label>
                    <input
                        type="number"
                        id="uang_bulanan"
                        name="uang_bulanan"
                        min="1"
                        placeholder="Contoh: 1000000"
                        value="<?= $uang_bulanan ?: "" ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="target_tabungan">Target Tabungan (Rp)</label>
                    <input
                        type="number"
                        id="target_tabungan"
                        name="target_tabungan"
                        min="0"
                        placeholder="Contoh: 200000"
                        value="<?= $target_tabungan ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="makan">🍛 Biaya Makan (Rp)</label>
                    <input
                        type="number"
                        id="makan"
                        name="makan"
                        min="0"
                        value="<?= $pengeluaran["Makan"] ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="transportasi">🚌 Transportasi (Rp)</label>
                    <input
                        type="number"
                        id="transportasi"
                        name="transportasi"
                        min="0"
                        value="<?= $pengeluaran["Transportasi"] ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="kuota">📱 Kuota Internet (Rp)</label>
                    <input
                        type="number"
                        id="kuota"
                        name="kuota"
                        min="0"
                        value="<?= $pengeluaran["Kuota Internet"] ?>"
                        required
                    >
                </div>

                <div class="field">
                    <label for="kuliah">📚 Kebutuhan Kuliah (Rp)</label>
                    <input
                        type="number"
                        id="kuliah"
                        name="kuliah"
                        min="0"
                        value="<?= $pengeluaran["Kebutuhan Kuliah"] ?>"
                        required
                    >
                </div>

                <div class="field full">
                    <label for="hiburan">🎮 Hiburan dan Lain-lain (Rp)</label>
                    <input
                        type="number"
                        id="hiburan"
                        name="hiburan"
                        min="0"
                        value="<?= $pengeluaran["Hiburan"] ?>"
                        required
                    >
                </div>

            </div>

            <p class="note">
                Masukkan nominal dalam rupiah tanpa titik atau tanda koma.
            </p>

            <button type="submit" name="hitung">
                Hitung Kondisi Keuanganku →
            </button>

        </form>
    </section>

    <?php if ($hasil): ?>

        <section class="card">
            <h2 class="title">📊 Hasil Analisis Keuangan</h2>

            <p style="margin-bottom: 18px;">
                Halo, <strong><?= htmlspecialchars($nama) ?></strong>!
                Berikut ringkasan keuangan bulananmu.
            </p>

            <div class="result-grid">

                <div class="summary">
                    <span>Uang Bulanan</span>
                    <h3><?= rupiah($uang_bulanan) ?></h3>
                </div>

                <div class="summary">
                    <span>Total Pengeluaran</span>
                    <h3><?= rupiah($total_pengeluaran) ?></h3>
                </div>

                <div class="summary">
                    <span>Sisa Uang</span>
                    <h3 class="<?= $sisa_uang < 0 ? 'money-negative' : 'money-left' ?>">
                        <?= rupiah($sisa_uang) ?>
                    </h3>
                </div>

                <div class="summary">
                    <span>Target Tabungan</span>
                    <h3><?= rupiah($target_tabungan) ?></h3>
                </div>

            </div>

            <?php
            $kelas_status = strtolower($status_keuangan);
            ?>

            <div class="status <?= $kelas_status ?>">
                <h3>Status Keuangan: <?= htmlspecialchars($status_keuangan) ?></h3>
                <p><?= htmlspecialchars($pesan) ?></p>
            </div>

            <h3 style="margin-top: 25px; color: #174caa;">
                Rincian Pengeluaran
            </h3>

            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $nomor = 1;

                        foreach ($pengeluaran as $kategori => $biaya) {
                            echo "<tr>";
                            echo "<td>" . $nomor . "</td>";
                            echo "<td>" . htmlspecialchars($kategori) . "</td>";
                            echo "<td>" . rupiah($biaya) . "</td>";
                            echo "</tr>";

                            $nomor++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p style="margin-top: 18px;">
                <strong>Kebiasaan hemat:</strong>
                <?= $status_hemat ? "Pengeluaran masih dalam batas 70% uang bulanan." : "Pengeluaran sudah melebihi 70% uang bulanan." ?>
            </p>

        </section>

    <?php endif; ?>

</main>

<footer>
    <p>Student Survival Calculator · Dibuat dengan PHP</p>
    <p>Kelola uang dengan bijak, kuliah tetap tenang ✨</p>
</footer>

</body>
</html>
