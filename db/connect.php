<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "tuto";
        private $username = "root";
        private $password = "";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
                $liste="CREATE TABLE IF NOT EXISTS `Liste` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `produit` varchar(256) NOT NULL,
                    `prix` varchar(50),
                    `nombre` int(11) NOT NULL,
                    `created` datetime NOT NULL,
                    PRIMARY KEY (`id`))";
                $this->conn->exec($liste);
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>