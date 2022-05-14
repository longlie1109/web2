<?php
    class Database {
        private $hostname = 'localhost';
        private $user ='root';
        private $password ='';
        private $dbname ='dota';

        private $conn = NULL;
        private $result = NULL;
        public function connect() {
            $this->conn = new mysqli($this->hostname , $this->user, $this->password, $this->dbname) ;
            if(!$this->conn)
            {
                echo "Ket noi that bai";
                exit();
            }
            else {
                mysqli_set_charset($this->conn, 'utf8');
            }
            return $this->conn;
        }
        public function execute($sql) {
            $this->result = $this->conn->query($sql);
            return $this->result;
        }
        public function  getData(){
            if($this->result )
            {
                $data = mysqli_fetch_array($this->result);
            }
            else {
                $data=0;
            }
            return $data;
        }
        public function showList(){
            if(!$this->result){
                return FALSE;
            }
            else while($datas = $this->getData()){
                $data[] = $datas;
            }
            return $data;
        }
        public function insert ($Name , $Price, $Img){
            $sql = "INSERT INTO  product(IDproduct, Name, Price, Img)VALUES(null,$Name, $Price, $Img)";
           return  $this->execute($sql);
        }
        public function update($ID,$Name , $Price, $Img){
            $sql = "UPDATE product SET Name = '$Name', Price = '$Price', Img = '$Img' WHERE id = '$ID"; 
            return $this->execute(sql);
        }
        public function delete($ID){
            $sql ="DELETE FROM product where id ='$ID";
            return $this->execute(sql);
        }
    }
?>