<?php
    class Kelas_Model extends Database{
        public function uploadTugas( $npm, $idmatkul, $semester, $nomorTugas, $file){
            try {
                $this->query("INSERT INTO tbnilai ( npm, idMatkul, semester, nomorTugas, file)
                VALUES (?, ?, ?, ? , ?)");
                $this->bind($npm, $idmatkul, $semester, $nomorTugas, $file);
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

        public function editBobot($idmatkul, $semester, $laprak, $responsi, $tubes){
            try{
                $this->query("UPDATE tbbobot
                SET bobot = ?
                WHERE idMatkul = ? AND semester = ? AND jenis = ?");
                $this->bind($laprak, $idmatkul, $semester, "Laprak");
                $this->execute();

                $this->query("UPDATE tbbobot
                SET bobot = ?
                WHERE idMatkul = ? AND semester = ? AND jenis = ?");
                $this->bind($responsi, $idmatkul, $semester, "Responsi");
                $this->execute();

                $this->query("UPDATE tbbobot
                SET bobot = ?
                WHERE idMatkul = ? AND semester = ? AND jenis = ?");
                $this->bind($tubes, $idmatkul, $semester, "Tubes");
                $this->execute();

                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function addTugas($idmatkul, $semester, $jenis, $soal){
            try {
                $this->query("INSERT INTO tbtugas (idMatkul, semester, nomorTugas, jenis, deskripsi) 
                VALUES (?, ?, (
                    SELECT IFNULL(MAX(s.nomorTugas), 0) 
                    FROM tbtugas s 
                    WHERE s.idMatkul= ? AND s.semester= ?) + 1, 
                ?, ?);");
                $this->bind($idmatkul, $semester, $idmatkul, $semester, $jenis, $soal);
                $this->execute();
                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function getMhsOnKelas($idmatkul, $semester){
            $this->query("SELECT k.idMatkul, k.semester, m.npm, m.namaMhs, m.email, m.profileStatus 
            FROM tbkelas k
            LEFT JOIN tbmhs m ON k.npm = m.npm
            WHERE k.idMatkul = ? AND k.semester = ?");
            $this->bind($idmatkul, $semester);
            return $this->resSet();
        }

        public function editNilai($nilai, $npm, $idmatkul, $semester, $nomorTugas){
            try {
                $this->query("UPDATE tbnilai
                SET nilai = ?
                WHERE npm = ? AND idMatkul = ? AND semester = ? AND nomorTugas = ?");
                $this->bind($nilai, $npm, $idmatkul, $semester, $nomorTugas);
                $this->execute();
                return true;
            } catch (Exception $err){
                return false;
            }
        }

        public function getTugasAsdos($idmatkul, $semester, $nomorTugas){
            $this->query("SELECT k.npm, t.idMatkul, t.semester, t.nomorTugas, n.file, n.nilai 
            FROM tbtugas t 
                RIGHT JOIN tbkelas k 
                    ON t.idMatkul = k.idMatkul AND t.semester = k.semester
                LEFT JOIN tbnilai n 
                    ON k.npm = n.npm AND n.idMatkul = k.idMatkul AND t.nomorTugas = n.nomorTugas
            WHERE t.idMatkul = ? AND t.semester = ? AND t.nomorTugas = ?");
            $this->bind($idmatkul, $semester, $nomorTugas);
            return $this->resSet();
        }

        public function deleteTugasAsdos($idmatkul, $semester, $nomorTugas){
            try{
                //hapus yang di tb nilai dulu
                $this->query("DELETE FROM tbnilai WHERE idMatkul = ? AND semester = ? AND nomorTugas = ? OR nomorTugas = '0'");
                $this->bind($idmatkul, $semester, $nomorTugas);
                $this->execute();

                $this->query("UPDATE tbnilai SET nomorTugas = nomorTugas - 1
                WHERE idMatkul = ? AND semester = ? AND nomorTugas > ?");
                $this->bind($idmatkul, $semester, $nomorTugas);
                $this->execute();

                //trus tbtugas
                $this->query("DELETE FROM tbtugas WHERE idMatkul = ? AND semester = ? AND nomorTugas = ?");
                $this->bind($idmatkul, $semester, $nomorTugas);
                $this->execute();

                $this->query("UPDATE tbtugas SET nomorTugas = nomorTugas - 1
                WHERE idMatkul = ? AND semester = ? AND nomorTugas > ?");
                $this->bind($idmatkul, $semester, $nomorTugas);
                $this->execute();

                return true;
            } catch (Exception $err){
                return false;
            }
        }
    }
?>