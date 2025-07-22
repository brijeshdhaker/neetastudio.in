<?php

//
require './BaseResource.php';
require 'Slim/Slim.php';
//
\Slim\Slim::registerAutoloader();
/*
 * 
 */
$app = new \Slim\Slim();
$commonServices = new CommonServices();
$registrationService = new RegistrationService();
//
$app->post('/common/register', function() use ($app, $registrationService) {
    $logger = Logger::getLogger('CommonServiceResource');
    $response = new RestResponse();
    try {
        $jsonStr = $app->request()->getBody();
        if (!is_null($jsonStr) && isset($jsonStr)) {
            $request = json_decode($jsonStr);
            $registrationService->register($request,$response);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();   
        }
    } catch (Exception $exc) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $exc->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$exc->getTraceAsString());
        $response->addMessages($msg);
        $response->setMessage("System error occurred while processing your request");
        $response->setStatus(FALSE);
    }
    echo json_encode($response);
});
//
$app->post('/common/contact', function() use ($app, $commonServices) {
    $logger = Logger::getLogger('CommonServiceResource');
    $response = new RestResponse();
    try {
        $jsonStr = $app->request()->getBody();
        if (!is_null($jsonStr) && isset($jsonStr)) {
            $request = json_decode($jsonStr);
            $commonServices->contactUs($request,$response);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();
            $response->setMessage("System error occurred while processing your request");
            $response->setStatus(FALSE);
        }
    } catch (Exception $exc) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $exc->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$exc->getTraceAsString());
        $response->addMessages($msg);
        $response->setMessage("System error occurred while processing your request");
        $response->setStatus(FALSE);
    }
    echo json_encode($response);
});
//
$app->run();

