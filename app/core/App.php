<?php
    class App {
        private $controller = "login";
        private $method = "index";
        private $params = [];

        public function __construct() {
            $url = $this->parse();
            
            //controller
            if( !empty($url[0]) && file_exists("app/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            }

            include "app/controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller;
            
            //method
            if( !empty($url[1]) && method_exists($this->controller, $url[1])) {                
                $this->method = $url[1];
                unset($url[1]);
            }

            if (!empty($url)){
                $this->params = array_slice($url, 0);
            }

            // call controller, method
            $this->callMethod();
        }

        private function parse() {
            if (isset($_GET['url'])){
                $url = rtrim($_GET['url']);
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode("/", $url);

                return $url;
            }
        }

        private function callMethod(){
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }
?>