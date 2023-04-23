<?php
    //initialisasi data
    $banyak = [];
    $query = $data[0]->getBanyakTugas($data[1][0], $data[1][1]);
    while($res = $query->fetch_assoc()){
        $banyak[$res["jenis"]] = $res["banyak"]; 
    }

    $mhs = [];
    $query = $data[0]->getMhsKelas($data[1][0], $data[1][1]);
    while($res = $query->fetch_assoc()){
        array_push($mhs, array($res["npm"], $res["namaMhs"]));
    }

    $namaMatkul = null;
    if($namaMatkul = $data[0]->getMatkul($data[1][0])->fetch_assoc()){} else {
        $this->location("home");
    }
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Rekap laporan</h1>
            <h4>penilaian kelas <?= $namaMatkul["matkul"] ?> Semester <?= str_replace("-", " ", $data[1][1]) ?></h4>
        </div>
        <div class="col-3 m-3">
            <a href="<?= BASE_URL . "/kelas/index/" . join("/", $data[1]) ?>" class="btn-close float-end"></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">NPM</th>
                        <th scope="col">Nama</th>
                        <?php
                            //looping untuk memnprintoutkan header dari tabel berdasarkan banyak tugas 
                            $state = 1;
                            $val = null;
                            foreach ($banyak as $jenis) {
                                for ($index = 0; $index < $jenis; $index++) { 
                                    if($state == 1){
                                        $val = "Laprak";
                                    }
                                    if($state == 2){
                                        $val = "Responsi";
                                    }
                                    if($state == 3){
                                        $val = "Tubes";
                                    }
                                    echo "<th scope='col'>$val</th>";
                                }
                                $state++;
                            }
                        ?>
                        <th scope="col">Total Nilai</th>
                        <th scope="col">Nilai Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($mhs as $siswa){
                            echo "<tr>";
                            echo "<td>" . $siswa[0] . "</td>";
                            echo "<td>" . $siswa[1] . "</td>";
                            
                            //printout nilai dari awal
                            $val = "";
                            $tempQuery = $data[0]->getNilai($siswa[0], $data[1][0], $data[1][1]);
                            for ($index = 1; $index <= array_sum($banyak); $index++){
                                $res = $tempQuery->fetch_assoc();
                                if($res){
                                    if ($res["nomorTugas"] == $index){
                                        $val = $res["nilai"];
                                    }
                                } 
                                echo "<td>" . $val . "</td>";
                            }
                            
                            //printout total nilai dari query
                            $total = "";
                            $tempQuery = $data[0]->getTotalNilai($siswa[0], $data[1][0], $data[1][1]);
                            if ($res = $tempQuery->fetch_assoc()){
                                $total = $res["nilai"];
                            }
                            echo "<td>" . $total . "</td>";


                            //hitung huruf dari total nilai
                            $huruf = "E";
                            if ($total >= 85) {
                                $huruf = "A";
                            } else if($total >= 80) {
                                $huruf = "A-";
                            } else if($total >= 75) {
                                $huruf = "B+";
                            } else if($total >= 70) {
                                $huruf = "B";
                            } else if($total >= 65) {
                                $huruf = "B-";
                            } else if($total >= 60) {
                                $huruf = "C+";
                            } else if($total >= 55) {
                                $huruf = "C";
                            } else if($total >= 45) {
                                $huruf = "D";
                            } else {
                                $huruf = "E";
                            }

                            echo "<td>" . $huruf . "</td>";
                            echo "<tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>