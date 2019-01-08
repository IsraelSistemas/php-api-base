<?php

    include_once "../repositories/loginRepository.php";

    // Global variables
    $loginRepository = new LoginRepository;

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->post('/Login', function(Request $request, Response $response) {
        global $loginRepository;

        $data = $request->getParsedBody();

        $response = $loginRepository->Login($data);

        return $response;
    });

    $app->post('/RegisterUser', function(Request $request, Response $response) {
        global $loginRepository;

        $response = $loginRepository->RegisterUser(null);

        return $response;
    });

    $app->post('/ForgotPasswordMail', function(Request $request, Response $response) {
        global $loginRepository;

        $data = $request->getParsedBody();

        $response = $loginRepository->ForgotPasswordMail($data);

        return $response;
    });

    $app->post('/ForgotPassword', function(Request $request, Response $response) {
        global $loginRepository;

        $data = $request->getParsedBody();

        $response = $loginRepository->ForgotPassword($data);

        return $response;
    });

?>