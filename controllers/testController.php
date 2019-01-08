<?php 
    
    include_once "../helpers/helpers.php";
    include_once "../repositories/testRepository.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $helpers = new Helpers;
    $testRepository = new TestRepository;

    $app->get('/Test/GetData', function(Request $request, Response $response) {
        global $testRepository;
        global $helpers;
        $response = null;
        $access = $helpers->allowAccess();

        try {
            if ($access['Code'] == 200) {
                $response = $testRepository->GetAll();
            } else {
                $response = $access;
            }

            return json_encode($response);
        } catch (PDOException $e) {   
            return json_encode(array(
                "Error" => $e->getMessage()
            ));
        }
    });

    $app->get('/Test/GetDataById/{Id}', function(Request $request, Response $response) {
        global $testRepository;
        $query = null;

        try {
            $id = $request->getAttribute('Id');

            $query = $testRepository->GetById($id);

            return json_encode($query);
        } catch (PDOException $e) {   
            return json_encode(array(
                "Error" => $e->getMessage()
            ));
        }
    });

     $app->get('/Test/GenerateToken', function(Request $request, Response $response) {
        global $testRepository;
        
        $token = $testRepository->generateToken();

        echo $token;
    });

     $app->get('/Test/GetToken', function(Request $request, Response $response) {
        global $testRepository;
        
        $token = $testRepository->getToken();

        echo $token;
    });

     $app->get('/Test/DecodeToken', function(Request $request, Response $response) {
        global $testRepository;
        
        $testRepository->decodeToken();
    });

?>
