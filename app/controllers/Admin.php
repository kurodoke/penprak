<?php
    class Admin extends Controller {

        private function lengthen($num){
            $size = strlen($num);
            if ($size == 1){
                return "00" . $num;
            } else if ($size == 2){
                return "0" .$num;
            }
            return $num;
        }
        private function npmBuild($jurusan, $angkatan, $nomor){
            return $jurusan . $this->lengthen($angkatan) . $this->lengthen($nomor);
        }

        //view
        public function index() {
            $this->view("admin/index");
        }

        //proc
        public function addMhs(...$data){
            if($this->auth() && $_SESSION['role'] == "admin"){
                $model = $this->model("Admin_Model");
                $npm = $this->npmBuild($_POST['jurusan'], $_POST['angkatan'], $_POST['nomor']);
                if ($model->addMhs($npm, $_POST['nama'], $_POST['pass'])){
                    Flasher::setFlash("Berhasil", "Tambah mahasiswa", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }
                $this->location("home");
            } else {
                $this->location("");
            }
        }

        //proc
        public function addMatkul(...$data){
            if($this->auth() && $_SESSION['role'] == "admin"){
                $model = $this->model("Admin_Model");
                $tahun = (strlen($_POST['tahun']) == 1) ? 
                "0" . $_POST['tahun'] : $_POST['tahun'];
                if ($model->addMatkul(strtoupper($_POST['idmatkul']), $_POST['nama'], $_POST['semester']. "-20" . $tahun)){
                    Flasher::setFlash("Berhasil", "Tambah Matkul", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }
                $this->location("home");
            } else {
                $this->location("");
            }
        }
        
        //view
        public function matkul(...$data){
            if($this->auth() && $_SESSION["role"] == "admin"){
                $this->tnview("admin/matkul", $data);
            } else {
                $this->location("");
            }
        }
        
    }
?>