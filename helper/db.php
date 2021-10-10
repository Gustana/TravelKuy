<?php
    require_once('../../init/connection.php');

    class Database extends Connection{

        public function __construct(){
            parent::__construct();
        }

        //* register error code, start from 0
        //* 0-> failed to register, unexpected
        //* 01 -> email already registered
        public function registerUser($email, $pass, $nama, $usia, $jenisKelamin){
            if(!$this->isEmailExist($email)){

                $result = $this->conn
                ->query("INSERT INTO user(email, pass, nama, usia, jenis_kelamin) 
                        VALUES('$email', '$pass', '$nama', $usia, $jenisKelamin)");

                if($result){
                    return $this->successAuthResponse("success register");
                }else{
                    return $this->failedAuthResponse(0, "failed to register");
                }

            }else{
                return $this->failedAuthResponse(01, "email already registered");
            }
   
        }

        public function isEmailExist($email){
            $query = $this->conn
                    ->query("SELECT email, pass FROM user WHERE email = '$email'");

            if(!$query){
                die('Unexpected error in function isEmailExist');
            }

            return $query->num_rows==1;
            
        }

        //! admin default email admin@gmail.com
        //! admin default password admin
        //! admin default password already hashed

        //* register error code, start from 1
        //* 11-> failed to login, unexpected
        //* 12-> email hasn't registered

        public function login($email, $password){
            if(strcmp($email, "admin@gmail.com")==0 && strcmp($password, '$2y$10$xQl591VMKcwlGsobdRt3f.abv7EiSVC7/10pOFpOied')==0){
                //success login as admin
                return $this->successAuthResponse('success to login as admin');
            }else{
                if($this->isEmailExist($email)){
                    return $this->successAuthResponse('success to login as user');
                }else{
                    return $this->failedAuthResponse(12, 'email has\'t registered');
                }
            }
        }

        public function failedAuthResponse($code, $message){
            return $this->encodeJson($code, $message);
        }

        //* auth success default code is 1
        public function successAuthResponse($message){
            return $this->encodeJson(1, $message);
        }

        public function encodeJson($code, $message){
            echo json_encode(
                array(
                    "code" => $code,
                    "message" => $message
                )
            );
        }

    }

?>