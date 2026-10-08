<?php
function hitungLuas($panjang, $lebar)
{
    return $panjang * $lebar;
}

$hasil = hitungLuas(10, 5);
echo "Luas = " . $hasil;
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungsi</title>

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
</head>
<body>

    <h1>Fungsi PHP</h1>
    <p>Nama: Raihannisa</p>
    <p>NIM: 2530521009</p>
   
</body>
</html>
