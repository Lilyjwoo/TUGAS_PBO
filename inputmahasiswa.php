<?php

$nim = "";
$nama = "";
$fakultas = "";
$prodi = "";
$asal_sekolah = "";
$semester = "";
$hobi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST["nim"] ?? "";
    $nama = $_POST["nama"] ?? "";
    $fakultas = $_POST["fakultas"] ?? "";
    $prodi = $_POST["prodi"] ?? "";
    $asal_sekolah = $_POST["asal_sekolah"] ?? "";
    $semester = $_POST["semester"] ?? "";
    $hobi = $_POST["hobi"] ?? "";
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

        /* BACKGROUND LANGIT MALAM */

        body {
            margin: 0;
            font-family: "Palatino", Arial, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
            background: linear-gradient(135deg,
                    #020617,
                    #0f172a,
                    #172554,
                    #312e81,
                    #0f172a);
            background-size: 400% 400%;
            animation: backgroundMove 20s ease infinite;
            color: #1e293b;
            overflow-x: hidden;
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

        /* LANGIT BERBINTANG */

        .star-container {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 5;
        }

     
        .star {
            position: absolute;
            display: block;
            width: var(--size, 3px);
            height: var(--size, 3px);
            border-radius: 50%;
            background: #ffffff;
            box-shadow:
                0 0 6px #ffffff,
                0 0 12px #93c5fd,
                0 0 20px #818cf8;

            opacity: 0.5;
            animation:
                twinkle var(--duration, 3s) ease-in-out infinite,
                starMove var(--move-duration, 8s) ease-in-out infinite alternate;

            animation-delay: var(--delay, 0s);
        }

        .star.big {
            width: 5px;
            height: 5px;
            box-shadow:
                0 0 10px #ffffff,
                0 0 20px #93c5fd,
                0 0 30px #818cf8;
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.25;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes starMove {
            from {
                translate: 0 0;
            }

            to {
                translate: 15px 20px;
            }
        }


        /* BINTANG JATUH */


        .shooting-star {
            position: absolute;
            width: 140px;
            height: 3px;

            background: linear-gradient(
                90deg,
                transparent,
                #ffffff,
                #93c5fd,
                transparent
            );

            border-radius: 50%;
            box-shadow: 0 0 10px #93c5fd;

            opacity: 0;
            transform: rotate(-35deg);
            animation: shooting 5s linear infinite;
            animation-delay: var(--delay, 0s);
        }

        @keyframes shooting {
            0%, 70% {
                opacity: 0;
                transform: translate(0, 0) rotate(-35deg);
            }

            72% {
                opacity: 1;
            }

            85% {
                opacity: 0;
                transform: translate(-300px, 180px) rotate(-35deg);
            }

            100% {
                opacity: 0;
                transform: translate(-300px, 180px) rotate(-35deg);
            }
        }


        /* CONTAINER */

        .container {
            width: 100%;
            max-width: 700px;
            margin: auto;
            position: relative;
            z-index: 10;
        }

        /* HEADER */

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
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .header h1 {
            margin: 15px 0 5px;
            color: #ffffff;
            font-size: 30px;
            text-shadow: 0 0 15px rgba(147, 197, 253, 0.5);
        }

        .header p {
            margin: 0;
            color: #cbd5e1;
        }

        /* CARD FORM */

        .card {
            background: rgba(255, 255, 255, 0.96);
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
            margin-bottom: 25px;
            animation: cardAppear 0.8s ease;
            transition: 0.3s;
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
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.2);
        }

        .card-title {
            margin-top: 0;
            margin-bottom: 25px;
            color: #1e40af;
            font-size: 20px;
            border-bottom: 2px solid #dbeafe;
            padding-bottom: 12px;
        }

        /* FORM */

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
            border-color: #6366f1;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.13);
            transform: scale(1.01);
        }

        input:hover,
        select:hover {
            border-color: #a5b4fc;
        }

        input::placeholder {
            color: #94a3b8;
        }

        /* BUTTON */

        button {
            width: 100%;
            padding: 13px;
            margin-top: 8px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, #2563eb, #6d28d9);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #1d4ed8, #5b21b6);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        button:active {
            transform: scale(0.97);
        }

        /* HASIL DATA */

        .hasil {
            background: rgba(255, 255, 255, 0.97);
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: resultAppear 0.8s ease;
        }

        @keyframes resultAppear {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .hasil h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #3730a3;
            border-bottom: 2px solid #e0e7ff;
            padding-bottom: 12px;
        }

        /* DATA ITEM */

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
            overflow-wrap: anywhere;
        }

        /* FOOTER */

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #cbd5e1;
            font-size: 13px;
            animation: fadeDown 1.5s ease;
        }

        /* RESPONSIVE */

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

        /* Tombol Background Music */
        #musicButton {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 10;
            width: auto;
            margin: 0;
            padding: 12px 18px;
            border: 1px solid rgba(147, 197, 253, 0.5);
            border-radius: 30px;
            background: rgba(30, 41, 78, 0.9);
            color: white;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.25);
            backdrop-filter: blur(10px);
        }

        #musicButton:hover {
            transform: translateY(-3px);
            background: #3730a3;
        }



    </style>
</head>

<body>
  
    <!-- Background Music -->
    <audio id="bgm" loop>
        <source src="music/bgm.mp3" type="audio/mpeg">
        Browser kamu tidak mendukung audio.
    </audio>

    <button id="musicButton" type="button">
        🎵 Putar Musik
    </button>


    <!-- LANGIT MALAM PENUH BINTANG -->
    <div class="star-container" aria-hidden="true">

        <span class="star big" style="left:5%;top:12%;--duration:2s;--delay:0s;"></span>
        <span class="star" style="left:12%;top:28%;--size:2px;--duration:3s;--delay:1s;"></span>
        <span class="star" style="left:18%;top:8%;--size:3px;--duration:4s;--delay:2s;"></span>
        <span class="star big" style="left:25%;top:20%;--duration:2.5s;--delay:0.5s;"></span>
        <span class="star" style="left:32%;top:10%;--size:2px;--duration:3.5s;--delay:1.5s;"></span>
        <span class="star" style="left:38%;top:35%;--size:3px;--duration:2s;--delay:2s;"></span>
        <span class="star big" style="left:45%;top:7%;--duration:3s;--delay:1s;"></span>
        <span class="star" style="left:52%;top:24%;--size:2px;--duration:4s;--delay:0s;"></span>
        <span class="star" style="left:59%;top:13%;--size:3px;--duration:2.5s;--delay:2s;"></span>
        <span class="star big" style="left:66%;top:30%;--duration:3.5s;--delay:1s;"></span>
        <span class="star" style="left:73%;top:9%;--size:2px;--duration:2s;--delay:0.5s;"></span>
        <span class="star" style="left:80%;top:22%;--size:3px;--duration:4s;--delay:2.5s;"></span>
        <span class="star big" style="left:88%;top:12%;--duration:2.5s;--delay:1.5s;"></span>
        <span class="star" style="left:95%;top:35%;--size:2px;--duration:3s;--delay:0s;"></span>

        <span class="star" style="left:8%;top:48%;--size:2px;--duration:3s;--delay:1s;"></span>
        <span class="star big" style="left:16%;top:65%;--duration:2.5s;--delay:2s;"></span>
        <span class="star" style="left:28%;top:55%;--size:3px;--duration:4s;--delay:0.5s;"></span>
        <span class="star" style="left:35%;top:75%;--size:2px;--duration:3s;--delay:1.5s;"></span>
        <span class="star big" style="left:48%;top:60%;--duration:2s;--delay:2s;"></span>
        <span class="star" style="left:57%;top:78%;--size:2px;--duration:3.5s;--delay:0s;"></span>
        <span class="star" style="left:69%;top:55%;--size:3px;--duration:2.5s;--delay:1s;"></span>
        <span class="star big" style="left:78%;top:70%;--duration:3s;--delay:2.5s;"></span>
        <span class="star" style="left:90%;top:58%;--size:2px;--duration:4s;--delay:1s;"></span>
        <span class="star" style="left:96%;top:82%;--size:3px;--duration:2s;--delay:0.5s;"></span>

        <span class="star" style="left:3%;top:90%;--size:2px;--duration:3s;--delay:2s;"></span>
        <span class="star" style="left:22%;top:42%;--size:2px;--duration:4s;--delay:1s;"></span>
        <span class="star" style="left:42%;top:88%;--size:3px;--duration:2.5s;--delay:0.5s;"></span>
        <span class="star" style="left:63%;top:45%;--size:2px;--duration:3s;--delay:2s;"></span>
        <span class="star" style="left:84%;top:90%;--size:3px;--duration:4s;--delay:1s;"></span>

        <!-- BINTANG JATUH -->
        <span class="shooting-star" style="left:85%;top:15%;--delay:2s;"></span>
        <span class="shooting-star" style="left:60%;top:5%;--delay:10s;"></span>

    </div>

    <div class="container">

        <!-- HEADER -->
        <div class="header">

            <div class="icon">🎓</div>

            <h1>Data Mahasiswa</h1>

            <p>Silakan isi data mahasiswa dengan lengkap</p>

        </div>

        <!-- FORM -->
        <div class="card">

            <h2 class="card-title">
                📝 Form Biodata Mahasiswa
            </h2>

            <form method="POST">

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM"
                        value="<?= htmlspecialchars($nim) ?>" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Mahasiswa</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap"
                        value="<?= htmlspecialchars($nama) ?>" required>
                </div>

                <div class="form-group">
                    <label for="fakultas">Fakultas</label>

                    <select id="fakultas" name="fakultas" required>
                        <option value="">-- Pilih Fakultas --</option>

                        <option value="Sains dan Teknologi" <?= $fakultas == "Sains dan Teknologi" ? "selected" : "" ?>>
                            Sains dan Teknologi
                        </option>

                        <option value="Keguruan dan Ilmu Pendidikan" <?= $fakultas == "Keguruan dan Ilmu Pendidikan" ? "selected" : "" ?>>
                            Keguruan dan Ilmu Pendidikan
                        </option>

                        <option value="Pertanian" <?= $fakultas == "Pertanian" ? "selected" : "" ?>>
                            Pertanian
                        </option>

                        <option value="Hukum" <?= $fakultas == "Hukum" ? "selected" : "" ?>>
                            Hukum
                        </option>

                        <option value="Kesehatan" <?= $fakultas == "Kesehatan" ? "selected" : "" ?>>
                            Kesehatan
                        </option>

                        <option value="Ilmu Sosial" <?= $fakultas == "Ilmu Sosial" ? "selected" : "" ?>>
                            Ilmu Sosial
                        </option>

                        <option value="Ekonomi" <?= $fakultas == "Ekonomi" ? "selected" : "" ?>>
                            Ekonomi
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" placeholder="Masukkan program studi"
                        value="<?= htmlspecialchars($prodi) ?>" required>
                </div>

                <div class="form-group">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" id="asal_sekolah" name="asal_sekolah" placeholder="Masukkan asal sekolah"
                        value="<?= htmlspecialchars($asal_sekolah) ?>" required>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>

                    <select id="semester" name="semester" required>
                        <option value="">-- Pilih Semester --</option>

                        <?php for ($i = 1; $i <= 8; $i++) { ?>
                            <option value="<?= $i ?>" <?= $semester == (string) $i ? "selected" : "" ?>>
                                Semester <?= $i ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hobi">Hobi</label>
                    <input type="text" id="hobi" name="hobi" placeholder="Masukkan hobi"
                        value="<?= htmlspecialchars($hobi) ?>">
                </div>

                <button type="submit">
                    💾 Simpan Data
                </button>

            </form>

        </div>

        <!-- HASIL DATA -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

            <div class="hasil">

                <h2>📋 Data Mahasiswa</h2>

                <div class="data-item">
                    <span class="data-label">NIM</span>
                    <span class="data-value">
                        <?= htmlspecialchars($nim) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Nama</span>
                    <span class="data-value">
                        <?= htmlspecialchars($nama) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Fakultas</span>
                    <span class="data-value">
                        <?= htmlspecialchars($fakultas) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Program Studi</span>
                    <span class="data-value">
                        <?= htmlspecialchars($prodi) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Asal Sekolah</span>
                    <span class="data-value">
                        <?= htmlspecialchars($asal_sekolah) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Semester</span>
                    <span class="data-value">
                        Semester <?= htmlspecialchars($semester) ?>
                    </span>
                </div>

                <div class="data-item">
                    <span class="data-label">Hobi</span>
                    <span class="data-value">
                        <?= htmlspecialchars($hobi) ?>
                    </span>
                </div>

            </div>

        <?php } ?>

        <!-- FOOTER -->
        <div class="footer">
            ✦ Sistem Informasi Data Mahasiswa ✦
        </div>

    </div>

    <script>
        const bgm = document.getElementById("bgm");
        const musicButton = document.getElementById("musicButton");

        bgm.volume = 0.25;

        musicButton.addEventListener("click", async function () {
            if (bgm.paused) {
                try {
                    await bgm.play();
                    musicButton.textContent = "🔇 Matikan Musik";
                } catch (error) {
                    alert("Musik gagal diputar. Periksa file music/bgm.mp3.");
                }
            } else {
                bgm.pause();
                musicButton.textContent = "🎵 Putar Musik";
            }
        });
    </script>


</body>

</html>