<?php
    class Rekap_Model extends Database {
        public function getMatkul($idmatkul){
            $this->query("SELECT * FROM tbmatkul
            WHERE idMatkul = ?");
            $this->bind($idmatkul);
            return $this->resSet();
        }
        
        public function getBanyakTugas($idmatkul, $semester){
            $this->query("SELECT b.idMatkul, b.semester, b.jenis, COUNT(t.jenis) AS banyak, b.bobot
            FROM tbtugas t			
                RIGHT JOIN tbbobot b ON b.idMatkul = t.idMatkul AND b.semester = t.semester AND t.jenis = b.jenis
            WHERE b.idMatkul = ? AND b.semester = ?
            GROUP BY b.idMatkul, b.semester, b.jenis");
            $this->bind($idmatkul, $semester);
            return $this->resSet();
        }

        public function getMhsKelas($idmatkul, $semester){
            $this->query("SELECT k.idMatkul, k.semester, m.npm, m.namaMhs FROM tbkelas k
            LEFT JOIN tbmhs m ON k.npm = m.npm
            WHERE k.idMatkul = ? AND k.semester = ?");
            $this->bind($idmatkul, $semester);
            return $this->resSet();
        }

        public function getNilai($user, $idmatkul, $semester){
            $this->query("SELECT n.npm, m.namaMhs, n.idMatkul, n.semester, t.jenis, n.nomorTugas , n.nilai
            FROM tbnilai n
                LEFT JOIN tbtugas t ON t.idMatkul = n.idMatkul AND t.semester = n.semester AND t.nomorTugas = n.nomorTugas
                LEFT JOIN tbmhs m ON n.npm = m.npm
            WHERE n.npm = ? AND n.idMatkul = ? AND n.semester = ?
            ORDER BY n.nomorTugas");
            $this->bind($user, $idmatkul, $semester);
            return $this->resSet();
        }

        public function getTotalNilai($user, $idmatkul, $semester){
            $this->query("SELECT npm, idMatkul, semester, SUM(rataNilai*bobot/100) AS nilai FROM (
                SELECT n.npm, n.idMatkul, n.semester, t.jenis, (n.nilai) AS rataNilai, bt.bobot 
                FROM tbnilai n
                    LEFT JOIN tbtugas t ON t.idMatkul = n.idMatkul AND t.semester = n.semester AND t.nomorTugas = n.nomorTugas
                    LEFT JOIN (
                        SELECT b.idMatkul, b.semester, b.jenis, COUNT(t.jenis) AS banyak, b.bobot
                        FROM tbtugas t
                            RIGHT JOIN tbbobot b ON b.idMatkul = t.idMatkul AND b.semester = t.semester AND t.jenis = b.jenis
                        GROUP BY b.idMatkul, b.semester, b.jenis
                    ) bt ON bt.idMatkul = n.idMatkul AND bt.semester = n.semester AND bt.jenis = t.jenis
                GROUP BY n.npm, n.idMatkul, n.semester, jenis
            ) main
            WHERE npm = ? AND idMatkul = ? AND semester = ?
            GROUP BY npm, idMatkul, semester");
            $this->bind($user, $idmatkul, $semester);
            return $this->resSet();
        }
    }
?>