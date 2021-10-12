<?php
    require_once('../../init/connection.php');

    class Database extends Connection{

        public function __construct(){
            parent::__construct();
        }

        public function registerUser($email, $pass, $nama, $usia, $jenisKelamin){
            if(!$this->isEmailExist($email)){

                $result = $this->conn
                ->query("INSERT INTO user(email, pass, nama, usia, jenis_kelamin) 
                        VALUES('$email', '$pass', '$nama', $usia, $jenisKelamin)");

                if($result){
                    return $this->successResponse("success register");
                }else{
                    return $this->failedResponse(11, "failed to register");
                }

            }else{
                return $this->failedResponse(12, "email already registered");
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

        public function login($email, $password){
            if(strcmp($email, "admin@gmail.com")==0 && strcmp($password, '$2y$10$xQl591VMKcwlGsobdRt3f.abv7EiSVC7/10pOFpOied')==0){
                //success login as admin
                return $this->successResponse('success to login as admin');
            }else{
                if($this->isEmailExist($email)){
                    //TODO verify password hash with password input
                    //TODO add error code with corresponding error, see the error list below

                    return $this->successResponse('success to login as user');
                }else{
                    return $this->failedResponse(21, 'email has\'t registered');
                }
            }
        }

        public function insertDestination($namaWisata, $lokasiWisata, $hargaWisata){
            $result = $this->conn
            ->query("INSERT INTO wisata(nama_wisata, lokasi_wisata, harga_wisata)
                    VALUES('$namaWisata', '$lokasiWisata', $hargaWisata)");

            if($result){
                return $this->successResponse('success to insert destination');
            }else{
                return $this->failedResponse(31, 'failed to insert destination');
            }
        }

        public function updateDestination($idWisata, $namaWisata, $lokasiWisata, $hargaWisata){
            $result = $this->conn
            ->query("
                UPDATE wisata SET 
                nama_wisata = '$namaWisata',
                lokasi_wisata = '$lokasiWisata',
                harga_wisata = '$hargaWisata'
                WHERE id_wisata = $idWisata
            ");

            if($result){
                return $this->successResponse('success to update destination');
            }else{
                return $this->failedResponse(32, 'failed to update destination');
            }
        }

        public function deleteDestination($idWisata){
            $result = $this->conn->query("DELETE FROM wisata WHERE id_wisata = $idWisata");

            if($result){
                return $this->successResponse('success to delete destination');
            }else{
                return $this->failedResponse(33, 'failed to delete destination');
            }
        }

        public function getDestination(){
            $result = $this->conn->query("SELECT * FROM wisata");

            if($result){
                return $this->successResponseWithData("success to get destination", $this->fetchData($result));
            }else{
                return $this->failedResponse(34, "failed to get destination");
            }
        }

        public function buyTicket($idUser, $tanggal, $jumlahTiket, $idWisata, $hargaTiket){
            $totalHarga = $hargaTiket * $jumlahTiket;

            $result = $this->conn
                ->query("
                    INSERT pembelian_tiket(id_user, tanggal, jumlah_tiket, id_wisata, total_harga)
                    VALUES ($idUser, $tanggal, $jumlahTiket, $idWisata, $totalHarga)
                ");

            if($result){
                return $this->successResponse('success to buy ticket');
            }else{
                return $this->failedResponse(41, 'failed to buy ticket');
            }
            
        }

        private function fetchData($result){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }


        //* register error code
        //* 11-> failed to register
        //* 12 -> email already registered

        //* login error code
        //* 21-> email hasn't registered
        //* 22-> wrong password

        //* destination error code
        //* 31-> failed to insert destination
        //* 32-> failed to update destination
        //* 33-> failed to delete destination
        //* 34-> failed to get destination

        //* ticket error code
        //* 41 ->faild to buy ticket

        private function failedResponse($code, $message){
            return $this->encodeJson($code, $message);
        }

        //* success response default code is 0

        private function successResponse($message){
            return $this->encodeJson(0, $message);
        }

        private function successResponseWithData($message, $data){
            return $this->encodeJsonWithData(
                0, 
                $message,
                $data
            );
        }

        private function encodeJson($code, $message){
            echo json_encode(
                array(
                    "code" => $code,
                    "message" => $message
                )
            );
        }

        private function encodeJsonWithData($code, $message, $data){
            echo json_encode(
                array(
                    "code" => $code,
                    "message" => $message,
                    "data" => $data
                )
            );
        }

    }

?>