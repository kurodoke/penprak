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
                } else if ($model->errno() == 1062) {
                    Flasher::setFlash("Error", "Data Sudah ada", "danger");
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
                } else if ($model->errno() == 1062) {
                    Flasher::setFlash("Error", "Data Sudah ada", "danger");
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
        
        //proc
        public function editMatkul(...$data){
            if($this->auth() && $_SESSION["role"] == "admin" && !empty($data[1])){
                $model = $this->model("Admin_Model");
                for($index = 0; $index < count($_POST['npm']); $index++ ){
                    if($_POST['status'][$index] == "Mahasiswa"){
                        if($model->addMhsToKelas($_POST['npm'][$index], $data[0], $data[1])){
                        } else {
                            Flasher::setFlash("Error", "Database", "danger");
                            break;
                        }
                    } else if ($_POST['status'][$index] == "Asisten Dosen"){
                        if($model->addMhsToAmpu($_POST['npm'][$index], $data[0], $data[1])){
                        } else {
                            Flasher::setFlash("Error", "Database", "danger");
                            break;
                        }
                    } else if ($_POST['status'][$index] == ""){
                        if($model->delMhsFromKelas($_POST['npm'][$index], $data[0], $data[1])){
                        } else {
                            Flasher::setFlash("Error", "Database", "danger");
                            break;
                        }
                    }
                    Flasher::setFlash("Berhasil", "Edit Matkul", "success");
                }
                $a = 1;
                $this->location("admin/matkul/" . join("/", $data));
            } else {
                $this->location("");
            }
        }

        //proc
        public function delMatkul(...$data){
            if($this->auth() && $_SESSION["role"] == "admin" && !empty($data[1])){
                $model = $this->model("Admin_Model");
                if($model->delMatkul($data[0], $data[1])){
                    Flasher::setFlash("Berhasil", "Hapus Matkul", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }
                $this->location("home");
            } else {
                $this->location("");
            }
        }

        //view
        public function mahasiswa(...$data){
            if($this->auth() && $_SESSION["role"] == "admin"){
                $this->tnview("admin/mahasiswa");
            } else {
                $this->location("");
            }
        }

        //proc
        public function delMhs(...$data){
            if($this->auth() && $_SESSION["role"] == "admin" && !empty($data[0])){
                $model = $this->model("Admin_Model");
                if($model->delMhs($data[0])){
                    Flasher::setFlash("Berhasil", "Hapus Mahasiswa", "success");
                } else {
                    Flasher::setFlash("Error", "Database", "danger");
                }
                $this->location("admin/mahasiswa");
            } else {
                $this->location("");
            }
        }
    }
?>