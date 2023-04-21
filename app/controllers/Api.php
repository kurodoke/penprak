<?php
    class Api extends Controller {
    
        //api
        public function profile(...$data){
            if ($this->auth()){
                $model = $this->model("Home_Model");
                if(!empty($data)){
                    if(isset($data[0]) && !empty($data[0])){
                        if($res = $model->getProfile($data[0])->fetch_assoc()){
                            echo json_encode($res);
                        } else {
                            echo json_encode(array(
                                "status" => "err",
                                "msg" => "no data found"
                            ));
                        }
                    }
                } else {
                    if ($res = $model->getProfile($_SESSION['user'])->fetch_assoc()){
                        echo json_encode($res);
                    } else {
                        echo json_encode(array(
                            "status" => "err",
                            "msg" => "no data found"
                        ));
                    }
                }
            } else {
                $this->location("");
            }
        }

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
                $index = 0;
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
                
                $json = json_encode($json);
                echo $json;
            } else {
                $this->location("");
            }
        }

        //api
        public function tugas(...$data){
            if ($this->auth()){
                $model = $this->model("Kelas_Model");
                if(!empty($data)){
                    $json = [];
                    $query = $model->getTugasv2($_SESSION['user'] , $data[0],  $data[1]);
                    while( $res = $query->fetch_assoc()){
                        array_push($json, $res);
                    }
                    $json = json_encode($json);
                    echo $json;
                } else {
                    echo json_encode(array(
                        "status" => "err",
                        "msg" => "no parameter found"
                    ));
                }
            } else {
                $this->location("");
            }
        }

        //api 
        public function bobot(...$data){
            if ($this->auth()){
                $model = $this->model("Kelas_Model");
                if(!empty($data)){
                    $json = [];
                    $query = $model->getBobot($data[0], $data[1]);
                    while( $res = $query->fetch_assoc()){
                        array_push($json, $res);
                    }
                    $json = json_encode($json);
                    echo $json;
                } else {
                    echo json_encode(array(
                        "status" => "err",
                        "msg" => "no parameter found"
                    ));
                }
            } else {
                $this->location("");
            }
        }

        //api
        public function matkul(...$data){
            $model = $this->model("Basic_Model");
            if(!empty($data)){
                $query = $model->matkul($data[0]);
                if( $res = $query->fetch_assoc()){
                    echo json_encode($res);
                } else {
                    echo json_encode(array(
                        "status" => "err",
                        "msg" => "no data found"
                    ));
                }
            } else {
                echo json_encode(array(
                    "status" => "err",
                    "msg" => "no parameter found"
                ));
            }
        }

        //api
        public function nilai(...$data){
            if($this->auth()){
                if(!empty($data)){
                    $model = $this->model("Kelas_Model");
                    $user = "";
                    if(!empty($data[2])){
                        $user = $data[2];
                    } else {
                        $user = $_SESSION["user"];
                    }
                    if($res = $model->getNilai($user, $data[0], $data[1])->fetch_assoc()){
                        echo json_encode($res);
                    } else {
                        echo json_encode(array(
                            "status" => "err",
                            "msg" => "no data found"
                        ));
                    }
                } else {
                    echo json_encode(array(
                        "status" => "err",
                        "msg" => "no parameter found"
                    ));
                }
            } else {
                $this->location("");
            }
        }

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
                echo json_encode($json);
            } else {
                $this->location("");
            }
        }
    }
?>