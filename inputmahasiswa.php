<?php

$nim = "";
$nama = "";
$fakultas = "";
$prodi = "";
$asal_sekolah = "";
$semester = "";
$hobi = "";

// Mengecek apakah form sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $fakultas = $_POST["fakultas"];
    $prodi = $_POST["prodi"];
    $asal_sekolah = $_POST["asal_sekolah"];
    $semester = $_POST["semester"];
    $hobi = $_POST["hobi"];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <style>
        * {
            box-sizing: border-box;
        }

        /* =========================
           BACKGROUND
        ========================== */

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;

            background: linear-gradient(-45deg,
                    #dbeafe,
                    #eff6ff,
                    #e0f2fe,
                    #dbeafe);

            background-size: 400% 400%;
            animation: backgroundMove 12s ease infinite;

            color: #1e293b;
        }

        @keyframes backgroundMove {

            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }

        }


        /* =========================
           CONTAINER
        ========================== */

        .container {
            width: 100%;
            max-width: 700px;
            margin: auto;
        }


        /* =========================
           HEADER
        ========================== */

        .header {
            text-align: center;
            margin-bottom: 25px;

            animation: fadeDown 1s ease;
        }

        @keyframes fadeDown {

            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        .header .icon {
            width: 65px;
            height: 65px;
            margin: auto;

            background: #2563eb;
            color: white;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;

            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);

            animation: floating 3s ease-in-out infinite;
        }

        /* Animasi icon naik turun */

        @keyframes floating {

            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }

        }


        .header h1 {
            margin: 15px 0 5px;
            color: #1e3a8a;
            font-size: 30px;
        }

        .header p {
            margin: 0;
            color: #64748b;
        }


        /* =========================
           CARD FORM
        ========================== */

        .card {
            background: white;
            padding: 30px;
            border-radius: 18px;

            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.10);

            margin-bottom: 25px;

            animation: cardAppear 0.8s ease;
        }

        @keyframes cardAppear {

            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.13);
            transition: 0.3s;
        }


        .card-title {
            margin-top: 0;
            margin-bottom: 25px;

            color: #1e40af;
            font-size: 20px;

            border-bottom: 2px solid #dbeafe;
            padding-bottom: 12px;
        }


        /* =========================
           FORM
        ========================== */

        .form-group {
            margin-bottom: 18px;

            animation: formAppear 0.7s ease;
        }

        @keyframes formAppear {

            from {
                opacity: 0;
                transform: translateX(-15px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }


        label {
            display: block;
            margin-bottom: 7px;

            font-weight: 600;
            color: #334155;
        }


        input,
        select {

            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cbd5e1;
            border-radius: 9px;

            font-size: 15px;

            outline: none;

            background-color: #f8fafc;

            transition: all 0.3s ease;
        }


        input:focus,
        select:focus {

            border-color: #2563eb;

            background-color: white;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);

            transform: scale(1.01);
        }


        input:hover,
        select:hover {

            border-color: #93c5fd;

        }


        input::placeholder {

            color: #94a3b8;

        }


        /* =========================
           BUTTON
        ========================== */

        button {

            width: 100%;

            padding: 13px;

            margin-top: 8px;

            border: none;

            border-radius: 9px;

            background: #2563eb;

            color: white;

            font-size: 16px;

            font-weight: 600;

            cursor: pointer;

            transition: all 0.3s ease;
        }


        button:hover {

            background: #1d4ed8;

            transform: translateY(-3px);

            box-shadow:
                0 8px 18px rgba(37, 99, 235, 0.30);
        }


        button:active {

            transform: scale(0.97);

        }


        /* =========================
           HASIL DATA
        ========================== */

        .hasil {

            background: white;

            padding: 30px;

            border-radius: 18px;

            box-shadow:
                0 10px 30px rgba(15, 23, 42, 0.10);

            animation: resultAppear 0.8s ease;
        }


        @keyframes resultAppear {

            from {

                opacity: 0;

                transform:
                    translateY(40px) scale(0.97);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0) scale(1);
            }

        }


        .hasil h2 {

            margin-top: 0;

            margin-bottom: 20px;

            color: #1e40af;

            border-bottom: 2px solid #dbeafe;

            padding-bottom: 12px;
        }


        /* =========================
           DATA ITEM
        ========================== */

        .data-item {

            display: flex;

            justify-content: space-between;

            gap: 20px;

            padding: 13px 0;

            border-bottom: 1px solid #e2e8f0;

            animation: dataSlide 0.5s ease;
        }


        @keyframes dataSlide {

            from {

                opacity: 0;

                transform: translateX(-20px);

            }

            to {

                opacity: 1;

                transform: translateX(0);

            }

        }


        .data-item:hover {

            padding-left: 8px;

            padding-right: 8px;

            background-color: #f8fafc;

            border-radius: 6px;

            transition: 0.3s;
        }


        .data-item:last-child {

            border-bottom: none;

        }


        .data-label {

            font-weight: 600;

            color: #64748b;

        }


        .data-value {

            text-align: right;

            color: #1e293b;

            font-weight: 500;

        }


        /* =========================
           FOOTER
        ========================== */

        .footer {

            text-align: center;

            margin-top: 20px;

            color: #64748b;

            font-size: 13px;

            animation: fadeDown 1.5s ease;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 600px) {

            body {

                padding: 25px 15px;

            }


            .card,
            .hasil {

                padding: 22px;

            }


            .header h1 {

                font-size: 25px;

            }


            .data-item {

                flex-direction: column;

                gap: 5px;

            }


            .data-value {

                text-align: left;

            }

        }
    </style>

</head>


<body>

    <div class="container">


        <!-- HEADER -->

        <div class="header">

            <div class="icon">
                🎓
            </div>

            <h1>
                Data Mahasiswa
            </h1>

            <p>
                Silakan isi data mahasiswa dengan lengkap
            </p>

        </div>



        <!-- FORM -->

        <div class="card">

            <h2 class="card-title">
                📝 Form Biodata Mahasiswa
            </h2>


            <form method="POST">


                <div class="form-group">

                    <label>
                        NIM
                    </label>

                    <input type="text" name="nim" placeholder="Masukkan NIM" required>

                </div>



                <div class="form-group">

                    <label>
                        Nama Mahasiswa
                    </label>

                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>

                </div>



                <div class="form-group">

                    <label>
                        Fakultas
                    </label>

                    <input type="text" name="fakultas" placeholder="Masukkan fakultas" required>

                </div>



                <div class="form-group">

                    <label>
                        Program Studi
                    </label>

                    <input type="text" name="prodi" placeholder="Masukkan program studi" required>

                </div>



                <div class="form-group">

                    <label>
                        Asal Sekolah
                    </label>

                    <input type="text" name="asal_sekolah" placeholder="Masukkan asal sekolah" required>

                </div>



                <div class="form-group">

                    <label>
                        Semester
                    </label>

                    <select name="semester" required>

                        <option value="">
                            -- Pilih Semester --
                        </option>

                        <option value="1">
                            Semester 1
                        </option>

                        <option value="2">
                            Semester 2
                        </option>

                        <option value="3">
                            Semester 3
                        </option>

                        <option value="4">
                            Semester 4
                        </option>

                        <option value="5">
                            Semester 5
                        </option>

                        <option value="6">
                            Semester 6
                        </option>

                        <option value="7">
                            Semester 7
                        </option>

                        <option value="8">
                            Semester 8
                        </option>

                    </select>

                </div>



                <div class="form-group">

                    <label>
                        Hobi
                    </label>

                    <input type="text" name="hobi" placeholder="Masukkan hobi">

                </div>



                <button type="submit">
                    💾 Simpan Data
                </button>


            </form>

        </div>



        <!-- HASIL DATA -->

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

            <div class="hasil">

                <h2>
                    📋 Data Mahasiswa
                </h2>


                <div class="data-item">

                    <span class="data-label">
                        NIM
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($nim) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Nama
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($nama) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Fakultas
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($fakultas) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Program Studi
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($prodi) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Asal Sekolah
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($asal_sekolah) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Semester
                    </span>

                    <span class="data-value">
                        Semester <?= htmlspecialchars($semester) ?>
                    </span>

                </div>



                <div class="data-item">

                    <span class="data-label">
                        Hobi
                    </span>

                    <span class="data-value">
                        <?= htmlspecialchars($hobi) ?>
                    </span>

                </div>

            </div>

        <?php } ?>



        <div class="footer">

            Sistem Informasi Data Mahasiswa

        </div>


    </div>

</body>

</html>
```