<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <style>
        body {
            background-image : url(aset/satu.jpg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            margin: 0 auto;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h1 {
            color: 	#BA55D3;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #EE82EE;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #DDA0DD;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px;
            background: #DDA0DD;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #EE82EE;
        }

        .output-box {
            margin-top: 20px;
            padding: 20px;
            background: #DDA0DD;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        .output-box strong {
            color: 	#663399;
        }
    </style>
</head>
<body>
    <center>
    <div class="container">
        <form method="post">
            <h1>Rental Motor</h1>
            <label for="nama">Nama Pelanggan :</label>
            <input type="text" name="nama" required>
            <label for="waktu">Lama Waktu Rental :</label>
            <input type="number" name="waktu" required>
            <label for="tipe">Tipe motor :</label>
            <select name="tipe" required>
                <option value="Aerox">Aerox</option>
                <option value="Scoopy">Scoopy</option>
                <option value="PCX">PCX</option>
                <option value="Vario">Vario</option>
                <option value="Vespa matic">Vespa Matic</option>
                <option value="CBR">CBR</option>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
    <?php
    class rental {
        public $harga;
        public $jenis;
        public $waktu;
        private $member = ['adelia', 'alifa', 'malika', 'indri', 'rahma', 'dini'];

        public function __construct($harga, $jenis, $waktu) {
            $this->harga = $harga;
            $this->jenis = $jenis;
            $this->waktu = $waktu;
        }

        public function pajak() {
            return 10000;
        }

        public function hitung() {
            $pajak = $this->pajak();
            $total = $this->harga * $this->waktu + $pajak;

            if (in_array(strtolower($this->jenis), $this->member)) {
                $diskon = 0.50 * $total;
                $total -= $diskon;
            }

            return $total;
        }
    }    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $waktu = $_POST["waktu"];
        $tipe = $_POST["tipe"];
        $harga_motor = 0;

        switch ($tipe) {
            case "Aerox":
                $harga_motor = 85000;
                break;
            case "Scoopy":
                $harga_motor = 65000;
                break;
            case "PCX":
                $harga_motor = 100000;
                break;
            case "Vario":
                $harga_motor = 80000;
                break;
            case "Vespa matic":
                $harga_motor = 85000;
                break;
            case "CBR":
                $harga_motor = 95000;
                break;
            default:
                echo "Tipe motor tidak valid.";
                break;
        }

        $rental = new rental($harga_motor, $nama, $waktu);
        $total_biaya = $rental->hitung();
        ?>    
        <div class="output-box">
        <?php
        echo "Total Biaya Rental Untuk <strong>$nama</strong> <br> Dengan Jenis Motor : <strong>($tipe)</strong> <br> Selama <strong>$waktu Hari</strong> Adalah: Rp. " . number_format($total_biaya, 2);
    }
    ?>
    </div>
    </center>
</body>
</html>
