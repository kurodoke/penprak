<?php
    class Kelas_Model extends Database{
        public function uploadTugas( $npm, $idMatkul, $semester, $nomorTugas, $file){
            try {
                $this->query("INSERT INTO tbnilai ( npm, idMatkul, semester, nomorTugas, file)
                VALUES (?, ?, ?, ? , ?)");
                $this->bind($npm, $idMatkul, $semester, $nomorTugas, $file);
                $this->execute();
                return true;
            } catch (Exception $err) {
                return false;
            }
        }

        public function getTugas($idmatkul, $semester){
            $this->query("SELECT idMatkul, semester, nomorTugas, jenis, deskripsi FROM tbtugas
            WHERE idMatkul = ? AND semester = ?");
            $this->bind($idmatkul, $semester);
            return $this->resSet();
        }

        public function getBobot($idmatkul, $semester){
            $this->query("SELECT idMatkul, semester, jenis, bobot FROM tbbobot
            WHERE idMatkul = ? AND semester = ?");
            $this->bind($idmatkul, $semester);
            return $this->resSet();
        }

        public function getTugasv2($user, $idmatkul, $semester){
            $this->query("SELECT tbtugas.idMatkul, tbtugas.semester, tbtugas.nomorTugas, jenis, deskripsi, 
            (SELECT file FROM tbnilai WHERE tbnilai.npm = ? AND tbnilai.idMatkul = tbtugas.idMatkul AND tbnilai.semester = tbtugas.semester AND tbnilai.nomorTugas = tbtugas.nomorTugas ) AS file,
            (SELECT nilai FROM tbnilai WHERE tbnilai.npm = ? AND tbnilai.idMatkul = tbtugas.idMatkul AND tbnilai.semester = tbtugas.semester AND tbnilai.nomorTugas = tbtugas.nomorTugas ) AS nilai
            FROM tbtugas 
            WHERE tbtugas.idMatkul = ? AND tbtugas.semester = ?");
            $this->bind($user, $user, $idmatkul, $semester);
            return $this->resSet();
        }

        public function getNilai($user, $idmatkul, $semester){
            $this->query("SELECT npm, idMatkul, semester, SUM(rataNilai*bobot/100) AS nilai FROM (
                SELECT n.npm, n.idMatkul, n.semester, t.jenis, SUM(n.nilai)/bt.banyak AS rataNilai, bt.bobot 
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