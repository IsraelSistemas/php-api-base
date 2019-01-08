<?php  
    
    require_once '../helpers/helpers.php';

    class TestRepository extends Helpers {

        public function __construct() {

        }

        public function GetAll() {
            $dbConection = Connection::connect();

            $query = "SELECT * 
                        FROM Data D;";

            $stmt = $dbConection->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);;

            return $result;
        } 

        public function GetById($id) {
            $dbConection = Connection::connect();

            $query = "SELECT * 
                        FROM Data D                        
                        WHERE D.id = :Id;";

            $stmt = $dbConection->prepare($query);

            $stmt->bindParam(":Id", $id);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }   

        public function generateToken() {
            return $this->generateAccessToken(null);
        }

        public function getToken() {            
            return $this->getBearerToken();
        }

        public function decodeToken() {
            $this->getCurrentUserId(null);
        }

    }

?>
