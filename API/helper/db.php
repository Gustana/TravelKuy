<?php
    require_once('../../init/connection.php');

    class Database extends Connection{

        public function __construct(){
            parent::__construct();
        }

        public function registerUser($email, $pass, $nama, $usia, $jenisKelamin){
            if(!$this->isEmailExist($email)){

                $pass = password_hash($pass, PASSWORD_DEFAULT);

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

        public function activateEmail($email){
            $result = $this->conn->query("UPDATE user SET status=1 WHERE email = '$email'");

            if($result){
                return $this->successResponse('success activate account');
            }else{
                return $this->failedResponse(13, 'failed to activate account');
            }
        }

        //* admin default email admin@gmail.com
        //* admin default password admin
        //* admin default password already hashed

        public function login($email, $password){
            if(strcmp($email, "admin@gmail.com")==0 && strcmp($password, '$2y$10$xQl591VMKcwlGsobdRt3f.abv7EiSVC7/10pOFpOied')==0){
                //success login as admin
                return $this->successResponse('success to login as admin');
            }else{
                if($this->isEmailExist($email)){

                    if($this->isEmailActivated($email)){

                        $result = $this->conn->query("SELECT pass FROM user WHERE email = '$email'");
                        $result = $result->fetch_object();

                        if(password_verify($password, $result->pass)){
                            return $this->successResponse('success to login as user');
                        }else{
                            return $this->failedResponse(22, 'failed to login, wrong password');
                        }
                    }else{
                        return $this->failedResponse(23, 'email has\'t activated');
                    }

                }else{
                    return $this->failedResponse(21, 'email has\'t registered');
                }
            }
        }

        public function updateUser($idUser, $password, $nama, $usia, $jenisKelamin){
            $result = $this->conn->query("UPDATE user 
                                        SET pass='$password', nama='$nama', usia=$usia, jenis_kelamin=$jenisKelamin
                                        WHERE id_user = $idUser
                                    ");

            if($result){
                return $this->successResponse('success to update profile');
            }else{
                return $this->failedResponse(51, 'failed to update profile');
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
                    INSERT tiket(id_user, tanggal, jumlah_tiket, id_wisata, total_harga)
                    VALUES ($idUser, $tanggal, $jumlahTiket, $idWisata, $totalHarga)
                ");

            if($result){
                return $this->successResponse('success to buy ticket');
            }else{
                return $this->failedResponse(41, 'failed to buy ticket');
            }
            
        }

        //! can only update date
        public function updateTicket($idTicket, $tanggal){
            $result = $this->conn->query("UPDATE tiket SET tanggal='$tanggal' WHERE id_tiket=$idTicket");

            if($result){
                return $this->successResponse('success to update ticket');
            }else{
                return $this->failedResponse(42, 'failed to update ticket');
            }
        }

        public function deleteTicket($idTicket){
            $result = $this->conn->query("DELETE FROM tiket WHERE id_tiket = $idTicket");

            if($result){
                return $this->successResponse('success to delete ticket');
            }else{
                return $this->failedResponse(43, 'failed to delete ticket');
            }
        }

        public function getTicketUser($idUser){
            $result = $this->conn
                    ->query("SELECT t.tanggal, t.jumlah_tiket, t.total_harga, w.nama_wisata, w.lokasi_wisata, w.harga_wisata
                            FROM tiket t JOIN wisata w ON t.id_wisata = w.id_wisata WHERE t.id_user=$idUser");

            if($result){
                $data = $this->fetchData($result);

                return $this->successResponseWithData('succes to get ticket list for user', $data);
            }else{
                return $this->failedResponse(44, 'failed to get ticket list for user');
            }
        }

        public function getTicketAdmin(){
            $result = $this->conn
                    ->query("SELECT t.tanggal, t.jumlah_tiket, t.total_harga, w.nama_wisata, w.lokasi_wisata, w.harga_wisata
                            FROM tiket t JOIN wisata w ON t.id_wisata = w.id_wisata");

            if($result){
                $data = $this->fetchData($result);

                return $this->successResponseWithData('succes to get ticket list for admin', $data);
            }else{
                return $this->failedResponse(45, 'failed to get ticket list for admin');
            }
        }

        private function isEmailActivated($email){
            $result = $this->conn->query("SELECT status FROM user WHERE email='$email'");

            if(!$result){
                die('Unexpected error in function isEmailActivated');
            }

            return $result->fetch_object()->status==1;
        }

        private function isEmailExist($email){
            $query = $this->conn
                    ->query("SELECT email, pass FROM user WHERE email = '$email'");

            if(!$query){
                die('Unexpected error in function isEmailExist');
            }

            return $query->num_rows==1;
            
        }

        private function fetchData($result){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }


        //* register error code
        //* 11-> failed to register
        //* 12-> email already registered
        //* 13-> failed to activate account

        //* login error code
        //* 21-> email hasn't registered
        //* 22-> wrong password
        //* 23-> email hasn't acctivated

        //* destination error code
        //* 31-> failed to insert destination
        //* 32-> failed to update destination
        //* 33-> failed to delete destination
        //* 34-> failed to get destination

        //* ticket error code
        //* 41-> failed to buy ticket
        //* 42-> failed to update ticket
        //* 43-> failed to delete ticket
        //* 44-> failed to get ticket user
        //* 45-> failed to get ticket admin

        //* user error code
        //* 51-> failed to update profile 

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