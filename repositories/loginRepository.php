<?php
    
    require_once '../helpers/helpers.php';

    class LoginRepository extends Helpers {

        public function __construct() {

        }

        public function Login($data) {
            $dbConnection = Connection::connect();
            $result = null;
            $respose = null;
            $keysResultArray = null;
            $matchPassword = false; 

            $query = "SELECT *
                        FROM Users
                        WHERE Email = :Email;";

            $stmt = $dbConnection->prepare($query);
            $stmt->bindParam(":Email", $data["Email"]);
            $stmt->execute();

            $rowsCount = $stmt->rowCount();

            if ($rowsCount > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $keysResultArray = $this->retrieveArrayProperties($result);

                if ($keysResultArray["IsActive"] == 0) {
                    $respose = $this->customResponse(0, "This account was disabled");
                } else {
                    $matchPassword = password_verify($data["Password"], $keysResultArray["Password"]);

                    if (!$matchPassword) {
                         $respose = $this->customResponse(0, "Password does not match");
                    } else {
                        $respose = json_encode($result);
                    }
                }
            } else {
                $respose = $this->throwErrorMessage(0, "This account does not exist");
            }

            return $result;
        } 

        public function RegisterUser($data) {
             return "RegisterUser";
        }

        public function ForgotPasswordMail($data) {
            $dbConnection = Connection::connect();
            $response = null;
            $keysResultArray = null;
            $matchPassword = false; 

            $query = "SELECT *
                        FROM Users
                        WHERE Email = :Email;";

            $stmt = $dbConnection->prepare($query);
            $stmt->bindParam(":Email", $data["Email"]);
            $stmt->execute();

            $rowsCount = $stmt->rowCount();

            if ($rowsCount > 0) {
                $this->sendMail($data);
                $response = $this->customResponse(200, "Mail sent successfully");
            } else {
                $response = $this->customResponse(0, "This account does not exist");
            }

            return $response;
        }

        public function ForgotPassword($data) {
            $dbConnection = Connection::connect();
            $response = null;

            $encryptedPassword = password_hash($data["Password"], PASSWORD_BCRYPT);

            $query = "UPDATE Users
                        SET Password = :EncryptedPassword
                        WHERE Email = :Email;";

            $stmt = $dbConnection->prepare($query);
            $stmt->bindParam(":EncryptedPassword", $encryptedPassword);
            $stmt->bindParam(":Email", $data["Email"]);


            $stmt->execute();

            $response = $this->throwSuccessMessage("Success", "Password updated successfully");

            return $response;
        }

    }

?>