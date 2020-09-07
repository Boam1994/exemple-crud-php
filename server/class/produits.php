<?php
    class Produits{

        // Connection
        private $conn;

        // Table
        private $db_table = "Liste";

        // Columns
        public $id;
        public $produit;
        public $prix;
        public $nombre;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getProducts(){
            $sqlQuery = "SELECT id, produit, prix, nombre, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        produit = :produit, 
                        prix = :prix, 
                        nombre = :nombre, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->produit=htmlspecialchars(strip_tags($this->produit));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":produit", $this->produit);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleProduct(){
            $sqlQuery = "SELECT
                        id, 
                        produit, 
                        prix, 
                        nombre, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->produit = $dataRow['produit'];
            $this->prix = $dataRow['prix'];
            $this->nombre = $dataRow['nombre'];
            $this->created = $dataRow['created'];
        }        

        // UPDATE
        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        produit = :produit, 
                        prix = :prix, 
                        nombre = :nombre
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->produit=htmlspecialchars(strip_tags($this->produit));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->nombre=htmlspecialchars(strip_tags($this->nombre));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":produit", $this->produit);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>