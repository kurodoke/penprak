<?php
    class Api extends Controller {
        //universal api
        //api
        public function profile(...$data){
            if ($this->auth()){
                $model = $this->model("Home_Model");
                $target = null;
                $json = [];

                if(isset($data[count($data)-1]) && !empty($data[count($data)-1])){
                    $target = $data[count($data)-1];
                } else {
                    $target = $_SESSION['user'];
                }

                if ($res = $model->getProfile($target)->fetch_assoc()){
                    $json = $res; 
                } 

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }

                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api mahasiswa
        //api
        public function kelasMhs(...$data){
            if ($this->auth()){
                $model = $this->model("Home_Model");
                $query = $model->kelasMhs($_SESSION['user']);

                if(!empty($data)){
                    if(isset($data[0]) && !empty($data[0])){
                        $query = $model->kelasMhs($data[0]);
                    }
                }
                
                $lastData = [];
                $json = [];
                for ($index = 0; $res = $query->fetch_assoc(); $index++){
                    if(!empty($lastData) && (
                        $lastData['npm'] == $res['npm'] && 
                        $lastData['idMatkul'] == $res['idMatkul'] && 
                        $lastData['semester'] == $res['semester'])){
                            $json[$index - 1]["asdos"][1] = $res["asdos"];
                    } else {
                        $temp = array(
                            "npm" => $res["npm"],
                            "matkul" => $res["matkul"],
                            "asdos" => [$res["asdos"]],
                            "nama" => $res["nama"],
                            "idMatkul" => $res["idMatkul"],
                            "semester" => $res["semester"]
                        );
                        array_push($json, $temp);
                        $lastData = $res;
                    }                    
                }
                
                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }

                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function tugas(...$data){
            if ($this->auth()){
                $model = $this->model("Kelas_Model");
                $json = [];
                
                if(!empty($data)){
                    $query = $model->getTugasv2($_SESSION['user'] , $data[0],  $data[1]);
                    while( $res = $query->fetch_assoc()){
                        array_push($json, $res);
                    }
                }                 
                
                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }

                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api 
        public function bobot(...$data){
            if ($this->auth()){
                $model = $this->model("Kelas_Model");
                $json = [];

                if(!empty($data)){
                    $query = $model->getBobot($data[0], $data[1]);
                    while( $res = $query->fetch_assoc()){
                        array_push($json, $res);
                    }
                } 

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }

                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function matkul(...$data){
            $model = $this->model("Basic_Model");
            $json = [];
            if(!empty($data)){
                $query = $model->matkul($data[0]);
                if( $res = $query->fetch_assoc()){
                    $json = $res;
                } 
            }
            
            if (empty($json)){
                $json = array(
                    "status" => "err",
                    "msg" => "no data found"
                );
            }
            echo json_encode($json);
        }

        //api
        public function nilai(...$data){
            if($this->auth()){
                $json = [];
                if(!empty($data)){
                    $model = $this->model("Kelas_Model");
                    $user = "";
                    if(!empty($data[2])){
                        $user = $data[2];
                    } else {
                        $user = $_SESSION["user"];
                    }
                    if($res = $model->getNilai($user, $data[0], $data[1])->fetch_assoc()){
                        $json = $res;
                    }
                }

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }

                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api asdos
        //api
        public function kelasAsdos(...$data){
            if($this->auth() && $_SESSION['role'] == "asdos"){
                $model = $this->model("Home_Model");
                $query = $model->kelasAsdos($_SESSION['user']);
                $json = [];
                if(!empty($data)){
                    if(isset($data[0]) && !empty($data[0])){
                        $query = $model->kelasAsdos($data[0]);
                    }
                }
                while( $res = $query->fetch_assoc()){
                    array_push($json, $res);
                }
                
                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function mahasiswa(...$data){
            if ($this->auth()){
                $model = $this->model("Kelas_Model");
                $json = [];
                if(!empty($data)){
                    if(isset($data[1]) && !empty($data[1])){
                        $query = $model->getMhsOnKelas($data[0], $data[1]);
                        while( $res = $query->fetch_assoc()){
                            array_push($json, $res);
                        }
                    }
                } 

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function tugasAsdos(...$data){
            if($this->auth() && !empty($data[2])){
                $model = $this->model("Kelas_Model");
                $json = [];
                $query = $model->getTugasAsdos($data[0], $data[1], $data[2]);
                while( $res = $query->fetch_assoc()){
                    array_push($json, $res);
                }

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }
        
        //api admin
        //api
        public function listMatkul(...$data){
            if ($this->auth()){
                $model = $this->model("Admin_Model");
                $json = [];
                $query = $model->getMatkul();
                while( $res = $query->fetch_assoc()){
                    array_push($json, $res);
                }

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function getAllMhs(...$data){
            if ($this->auth() && !empty($data[1])){
                $model = $this->model("Admin_Model");
                $json = [];
                $query = $model->getAllMhs($data[0], $data[1]);
                while( $res = $query->fetch_assoc()){
                    array_push($json, $res);
                }

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }

        //api
        public function getSimpleAllMhs(...$data){
            if ($this->auth()){
                $model = $this->model("Admin_Model");
                $json = [];
                $query = $model->getSimpleAllMhs();
                while( $res = $query->fetch_assoc()){
                    array_push($json, $res);
                }

                if (empty($json)){
                    $json = array(
                        "status" => "err",
                        "msg" => "no data found"
                    );
                }
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }
    }

?>